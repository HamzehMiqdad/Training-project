<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function __construct(
        private ProductService $productService
    ) {}

    public function index(Request $request)
    {
        $filters = [
            'search' => $request->input('q'),
            'category' => $request->input('category'),
            'subcategory' => $request->input('subcategory'),
            'per_page' => 9,
        ];

        $products = $this->productService->getAllProducts($filters)->withQueryString();
        $categories = $this->productService->getCategories();
        $subcategories = $this->productService->getSubcategories();

        return view('admin.dashboard', compact('products', 'categories', 'subcategories'));
    }
}
