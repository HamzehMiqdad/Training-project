<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;
use App\Services\SearchHistoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService,
        private SearchHistoryService $searchHistoryService
    ) {}

    /**
     * Get paginated list of products
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $filters = [
                'search' => $request->input('q'),
                'category' => $request->input('category'),
                'subcategory' => $request->input('subcategory'),
                'per_page' => $request->input('per_page', 9),
            ];

            // Record search if query exists
            if ($filters['search']) {
                $this->searchHistoryService->recordSearch($filters['search']);
            }

            $products = $this->productService->getProducts($filters);

            return response()->json([
                'products' => $products->items(),
                'meta' => [
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total(),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch products',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get a single product
     */
    public function show(Product $product): JsonResponse
    {
        try {
            $product = $this->productService->getProduct($product->id);

            return response()->json([
                'data' => $product,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch product',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get field suggestions (autocomplete)
     */
    public function suggestions(Request $request, string $field): JsonResponse
    {
        try {
            $query = $request->input('q', '');
            $suggestions = $this->productService->getFieldSuggestions($field, $query);

            return response()->json([
                'data' => $suggestions,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch suggestions',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get top products, categories, etc.
     */
    public function featured(Request $request): JsonResponse
    {
        try {
            $topCategories = $this->productService->getTopCategories();
            $topProducts = $this->productService->getTopProducts();
            $newProducts = $this->productService->getNewProducts();
            $categories = $this->productService->getCategories();
            $subcategories = $this->productService->getSubcategories();
            $advertisements = $this->productService->getAdvertisements();

            return response()->json([
                'data' => [
                    'top_categories' => $topCategories,
                    'top_products' => $topProducts,
                    'new_products' => $newProducts,
                    'categories' => $categories,
                    'subcategories' => $subcategories,
                    'advertisements' => $advertisements,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch featured data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}

