<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Advertisement;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    /**
     * Get paginated products with filters
     */
    public function getProducts(array $filters = []): LengthAwarePaginator
    {
        $query = Product::where('availabe_for_sale', true);

        if (isset($filters['search'])) {
            $query->where('name', 'like', "%{$filters['search']}%");
        }

        if (isset($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        if (isset($filters['subcategory'])) {
            $query->where('subcategory', $filters['subcategory']);
        }

        return $query->latest()->paginate($filters['per_page'] ?? 9);
    }

    /**
     * Get all products with filters (for admin - includes unavailable products)
     */
    public function getAllProducts(array $filters = []): LengthAwarePaginator
    {
        $query = Product::query();

        if (isset($filters['search'])) {
            $query->where('name', 'like', "{$filters['search']}%");
        }

        if (isset($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        if (isset($filters['subcategory'])) {
            $query->where('subcategory', $filters['subcategory']);
        }

        return $query->latest()->paginate($filters['per_page'] ?? 9);
    }

    /**
     * Get user's products
     */
    public function getUserProducts(int $userId, ?string $search = null): Collection
    {
        $query = Product::where('user_id', $userId);

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        return $query->latest()->get();
    }

    /**
     * Get product statistics for user
     */
    public function getUserProductStats(int $userId): array
    {
        $products = Product::where('user_id', $userId)->get();

        return [
            'total_hits' => $products->sum('hits'),
            'top_product' => $products->sortByDesc('hits')->first(),
            'total_products' => $products->count(),
        ];
    }

    /**
     * Get a single product by ID
     */
    public function getProduct(int $id): Product
    {
        $product = Product::with('user')->findOrFail($id);
        $product->increment('hits');
        return $product;
    }

    /**
     * Create a new product
     */
    public function createProduct(array $data, int $userId): Product
    {
        // Handle image upload
        if (isset($data['image']) && $data['image']) {
            $data['image'] = $data['image']->store('products', 'public');
        } else {
            $data['image'] = null;
        }

        // Handle available_for_sale checkbox
        $data['availabe_for_sale'] = isset($data['availabe_for_sale']) && $data['availabe_for_sale'];

        // Associate with user
        $data['user_id'] = $userId;

        return Product::create($data);
    }

    /**
     * Update a product
     */
    public function updateProduct(Product $product, array $data): Product
    {
        // Handle image upload
        if (isset($data['image']) && $data['image']) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $data['image']->store('products', 'public');
        }

        // Handle available_for_sale checkbox - convert to boolean if present
        if (isset($data['availabe_for_sale'])) {
            $data['availabe_for_sale'] = (bool) $data['availabe_for_sale'];
        }

        $product->update($data);
        return $product->fresh();
    }

    /**
     * Delete a product
     */
    public function deleteProduct(Product $product): bool
    {
        // Delete associated image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        return $product->delete();
    }

    /**
     * Get top categories based on sum of product hits
     */
    public function getTopCategories(int $limit = 3): SupportCollection
    {
        return Product::select('category')
            ->selectRaw('SUM(hits) as total_hits')
            ->groupBy('category')
            ->orderByRaw('SUM(hits) DESC')
            ->limit($limit)
            ->pluck('category');
    }

    /**
     * Get top products by hits
     */
    public function getTopProducts(int $limit = 3): Collection
    {
        return Product::where('availabe_for_sale', true)
            ->orderByDesc('hits')
            ->limit($limit)
            ->get();
    }

    /**
     * Get new products
     */
    public function getNewProducts(int $limit = 3): Collection
    {
        return Product::where('availabe_for_sale', true)
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Get field suggestions (for autocomplete)
     */
    public function getFieldSuggestions(string $field, string $query, int $limit = 10): SupportCollection
    {
        $allowed = ['category', 'subcategory'];
        if (!in_array($field, $allowed)) {
            return collect([]);
        }

        return Product::query()
            ->where($field, 'like', "%{$query}%")
            ->distinct()
            ->limit($limit)
            ->pluck($field);
    }

    /**
     * Get all categories
     */
    public function getCategories(): SupportCollection
    {
        return Product::select('category')->distinct()->pluck('category');
    }

    /**
     * Get all subcategories
     */
    public function getSubcategories(): SupportCollection
    {
        return Product::select('subcategory')->distinct()->pluck('subcategory');
    }

    /**
     * Get advertisements for product pages
     */
    public function getAdvertisements(): array
    {
        $ads = Advertisement::active()->get();
        
        return [
            'top' => $ads->where('place', 'products_top')->count() 
                ? $ads->where('place', 'products_top')->random() 
                : null,
            'sidebar' => $ads->where('place', 'products_sidebar')->count() 
                ? $ads->where('place', 'products_sidebar')->random() 
                : null,
            'bottom' => $ads->where('place', 'products_bottom')->count() 
                ? $ads->where('place', 'products_bottom')->random() 
                : null,
        ];
    }

    /**
     * Toggle product availability
     */
    public function toggleAvailability(Product $product): Product
    {
        $product->update([
            'availabe_for_sale' => !$product->availabe_for_sale
        ]);

        return $product->fresh();
    }

    /**
     * Bulk toggle product availability
     */
    public function bulkToggleAvailability(array $productIds, bool $enable): int
    {
        return Product::whereIn('id', $productIds)
            ->update(['availabe_for_sale' => $enable]);
    }
}

