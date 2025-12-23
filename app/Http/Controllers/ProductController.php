<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Advertisement;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        // قاعدة للفلترة العامة
        $productsQuery = Product::where('availabe_for_sale', true)
            ->when($query, fn($q) => $q->where('name', 'like', "%{$query}%"));

        if ($request->filled('category')) {
            $productsQuery->where('category', $request->category);
        }

        if ($request->filled('subcategory')) {
            $productsQuery->where('subcategory', $request->subcategory);
        }

        // باقي المنتجات (Other Products) مع Pagination
        $products = $productsQuery->latest()->paginate(9)->withQueryString();

        // Top Categories
        $topCategories = Product::select('category')
            ->groupBy('category')
            ->orderByRaw('COUNT(*) DESC')
            ->pluck('category')
            ->take(3);

        // Top Products (hits)
        $topProducts = Product::where('availabe_for_sale', true)
            ->orderByDesc('hits')
            ->take(3)
            ->get();

        // New Products
        $newProducts = Product::where('availabe_for_sale', true)
            ->latest()
            ->take(3)
            ->get();

        // الإعلانات
        $ads = Advertisement::active()->get();
        $ad_top = $ads->where('place', 'products_top')->count() ? $ads->where('place', 'products_top')->random() : null;
        $ad_sidebar = $ads->where('place', 'products_sidebar')->count() ? $ads->where('place', 'products_sidebar')->random() : null;
        $ad_bottom = $ads->where('place', 'products_bottom')->count() ? $ads->where('place', 'products_bottom')->random() : null;

        $categories = Product::select('category')->distinct()->pluck('category');
        $subcategories = Product::select('subcategory')->distinct()->pluck('subcategory');

        return view('home', compact(
            'topCategories',
            'topProducts',
            'newProducts',
            'products',
            'categories',
            'subcategories',
            'ad_top',
            'ad_sidebar',
            'ad_bottom'
        ));
    }





    public function show(Product $product)
    {
        $product->increment('hits');

        $product->load('user');
        return view('products.show', [
            'product' => $product
        ]);
    }
    public function suggestions(Request $request, $field)
    {
        $allowed = ['category', 'subcategory'];
        if (!in_array($field, $allowed)) {
            return response()->json([]);
        }

        $query = $request->get('q', '');

        $values = Product::query()
            ->where($field, 'like', "%{$query}%")
            ->distinct()
            ->limit(10)
            ->pluck($field);

        return response()->json($values);
    }
    public function search(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string']
        ]);

        $products = Product::where('name', 'like', '%' . $request['name'] . '%');
        if ($request['category']) {
            $products = $products->where('category', '=', $request['category']);
        }
        return view('', [
            'products' => $products->paginate(5)
        ]);
    }

}
