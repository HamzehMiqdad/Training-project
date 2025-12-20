<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        $products = Product::where('name', 'like', "{$query}%");
        if ($request->filled('category')) {
            $products->where('category', $request->category);
        }

        if ($request->filled('subcategory')) {
            $products->where('subcategory', $request->subcategory);
        }
        $products = $products->latest()->paginate(9)->withQueryString();
        
        $categories = Product::select('category')
            ->distinct()
            ->pluck('category');

        $subcategories = Product::select('subcategory')
            ->distinct()
            ->pluck('subcategory');
        return view('admin.dashboard',compact('products','categories','subcategories'));
    }
}
