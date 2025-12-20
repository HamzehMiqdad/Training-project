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

        $products = Product::where('availabe_for_sale', true)
            ->where('name', 'like', "{$query}%");

        if ($request->filled('category')) {
            $products->where('category', $request->category);
        }

        if ($request->filled('subcategory')) {
            $products->where('subcategory', $request->subcategory);
        }

        $products = $products->latest()->paginate(9)->withQueryString();

        $categories = Product::select('category')->distinct()->pluck('category');
        $subcategories = Product::select('subcategory')->distinct()->pluck('subcategory');

        // جلب إعلان عشوائي لكل مكان
        $ads = Advertisement::active()->get();
        $ad_top = $ads->where('place', 'products_top');
        $ad_top = $ad_top->count() ? $ad_top->random() : null;

        $ad_sidebar = $ads->where('place', 'products_sidebar');
        $ad_sidebar = $ad_sidebar->count() ? $ad_sidebar->random() : null;

        $ad_bottom = $ads->where('place', 'products_bottom');
        $ad_bottom = $ad_bottom->count() ? $ad_bottom->random() : null;

        return view('home', compact(
            'products', 'categories', 'subcategories',
            'ad_top', 'ad_sidebar', 'ad_bottom'
        ));
    }


  
    public function show(Product $product){
        $product->increment('hits');
        
        $product->load('user');
        return view('products.show',[
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
    public function search(Request $request){
        $request->validate([
            'name' => ['required','string','max:255'],
            'category'=>['nullable','string']
        ]);

        $products = Product::where('name','like','%'.$request['name'].'%');
        if($request['category']){
            $products = $products->where('category','=',$request['category']);
        }
        return view('',[
            'products' => $products->paginate(5)
        ]);
    }

}
