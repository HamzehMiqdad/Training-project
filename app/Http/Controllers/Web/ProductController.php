<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;
use App\Services\SearchHistoryService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService,
        private SearchHistoryService $searchHistoryService
    ) {}

    public function index(Request $request)
    {
        $query = $request->input('q');
        
        // Record search if query exists
        if ($query) {
            $this->searchHistoryService->recordSearch($query);
        }

        // Get products with filters
        $filters = [
            'search' => $query,
            'category' => $request->input('category'),
            'subcategory' => $request->input('subcategory'),
            'per_page' => 9,
        ];

        $products = $this->productService->getProducts($filters)->withQueryString();

        // Get featured data
        $topCategories = $this->productService->getTopCategories();
        $topProducts = $this->productService->getTopProducts();
        $newProducts = $this->productService->getNewProducts();
        $categories = $this->productService->getCategories();
        $subcategories = $this->productService->getSubcategories();
        $advertisements = $this->productService->getAdvertisements();

        $ad_top = $advertisements['top'];
        $ad_sidebar = $advertisements['sidebar'];
        $ad_bottom = $advertisements['bottom'];

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
        $product = $this->productService->getProduct($product->id);

        return view('products.show', [
            'product' => $product
        ]);
    }

    public function suggestions(Request $request, $field)
    {
        $query = $request->get('q', '');
        $suggestions = $this->productService->getFieldSuggestions($field, $query);

        return response()->json($suggestions);
    }
  

}
