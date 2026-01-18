<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // Statistics
        $stats = [
            'total_users' => User::where('activated', true)->count(),
            'total_products' => Product::where('availabe_for_sale', true)->count(),
            'total_hits' => Product::sum('hits'),
            'new_users_last_month' => User::where('activated', true)
                ->where('created_at', '>=', now()->subMonth())
                ->count(),
            'new_products_last_month' => Product::where('availabe_for_sale', true)
                ->where('created_at', '>=', now()->subMonth())
                ->count(),
        ];

        return view('admin.dashboard', compact('products', 'categories', 'subcategories', 'stats'));
    }
}
