<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function toggle(Product $product)
    {
        $product->update([
            'availabe_for_sale' => ! $product->availabe_for_sale
        ]);

        return back()->with('success', 'Product status updated');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('success', 'Product deleted');
    }

    public function bulkToggle(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'action' => 'required|in:enable,disable',
        ]);

        Product::whereIn('id', $request->products)
            ->update([
                'availabe_for_sale' => $request->action === 'enable'
            ]);

        return back()->with('success', 'Products updated successfully');
    }



}
