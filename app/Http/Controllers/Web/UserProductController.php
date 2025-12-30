<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    public function __construct(
        private ProductService $productService
    ) {}

    public function index(Request $request)
    {
        $user = auth()->user();
        $search = $request->input('q');

        $products = $this->productService->getUserProducts($user->id, $search);
        $stats = $this->productService->getUserProductStats($user->id);

        return view('dashboard', compact(
            'products',
            'search'
        ))->with([
            'totalHits' => $stats['total_hits'],
            'topProduct' => $stats['top_product'],
        ]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['availabe_for_sale'] = $request->has('availabe_for_sale');
        
        $this->productService->createProduct($data, $request->user()->id);
        
        return redirect('/dashboard')->with('success', 'Product Added Successfully');
    }

    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    public function update(Product $product, UpdateProductRequest $request)
    {
        $data = $request->validated();
        $data['availabe_for_sale'] = $request->has('availabe_for_sale');
        
        $this->productService->updateProduct($product, $data);
        
        return redirect('/dashboard')->with('success', 'Product Updated Successfully');
    }

    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);
        
        return redirect('/dashboard')->with('success', 'Product Deleted Successfully');
    }

}
