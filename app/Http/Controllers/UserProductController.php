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
    public function index(Request $request)
    {
        $user = auth()->user();
        $search = $request->input('q');

        $productsQuery = Product::where('user_id', $user->id)
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });

        $products = $productsQuery->latest()->get();

        $totalHits = $products->sum('hits');

        $topProduct = $products->sortByDesc('hits')->first();

        return view('dashboard', compact(
            'products',
            'totalHits',
            'topProduct',
            'search'
        ));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        } else {
            $data['image'] = null;
        }
        $data['availabe_for_sale'] = $request->has('availabe_for_sale');
        // associate with authenticated user
        Auth::user()->products()->create($data);
        return redirect('/dashboard')->with('success', 'Product Added Successfully');
    }

    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }
    public function update(Product $product, UpdateProductRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        $data['availabe_for_sale'] = $request->has('availabe_for_sale');
        $product->update($data);
        return redirect('/dashboard')->with('sucess', 'Product Updated Successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/dashboard')->with('success', 'Product Deleted Successfully');
    }

}
