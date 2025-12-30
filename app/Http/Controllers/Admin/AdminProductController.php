<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function __construct(
        private ProductService $productService
    ) {}

    public function toggle(Product $product)
    {
        $this->productService->toggleAvailability($product);

        return back()->with('success', 'Product status updated');
    }

    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);

        return back()->with('success', 'Product deleted');
    }

    public function bulkToggle(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'action' => 'required|in:enable,disable',
        ]);

        $this->productService->bulkToggleAvailability(
            $request->products,
            $request->action === 'enable'
        );

        return back()->with('success', 'Products updated successfully');
    }
}
