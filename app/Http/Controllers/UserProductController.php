<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Advertisement;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserProductController extends Controller
{
    public function index(Request $request){
        $query = $request->input('q');

        $products = Product::where('user_id', auth()->id())
            ->when($query, function($q) use ($query) {
                $q->where('name', 'like', "{$query}%");
            });
         
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

        $ads = Advertisement::active()->get();
        $ad_top = $ads->where('place', 'products_top');
        $ad_top = $ad_top->count() ? $ad_top->random() : null;

        $ad_sidebar = $ads->where('place', 'products_sidebar');
        $ad_sidebar = $ad_sidebar->count() ? $ad_sidebar->random() : null;

        $ad_bottom = $ads->where('place', 'products_bottom');
        $ad_bottom = $ad_bottom->count() ? $ad_bottom->random() : null;

        
        return view('dashboard', compact(
            'products', 'categories', 'subcategories',
            'ad_top', 'ad_sidebar', 'ad_bottom'
        ));
    }
    public function create()
    {
        return view('products.create');
    }
   
     public function store(StoreProductRequest $request){
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        } else {
            $data['image'] = null;
        }
        $data['availabe_for_sale'] =$request->has('availabe_for_sale');
        // associate with authenticated user
        Auth::user()->products()->create($data);
        return redirect('/dashboard')->with('success', 'Product Added Successfully');
    }

    public function edit(Product $product){
        return view('products.edit',['product'=>$product]);
    }
    public function update(Product $product, UpdateProductRequest $request){
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        return redirect('/dashboard')->with('sucess','Product Updated Successfully');
    }

    public function destroy(Product $product){
        $product->delete();
        return redirect('/dashboard')->with('success', 'Product Deleted Successfully');
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
            'products' => $products->paginate(6)
        ]);
    }
}
