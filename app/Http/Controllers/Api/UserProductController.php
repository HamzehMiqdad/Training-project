<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    public function __construct(
        private ProductService $productService
    ) {}

    /**
     * Get user's products with statistics
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $search = $request->input('q');
            $products = $this->productService->getUserProducts($request->user()->id, $search);
            $stats = $this->productService->getUserProductStats($request->user()->id);

            return response()->json([
                'data' => $products,
                'stats' => $stats,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch user products',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Create a new product
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $data['availabe_for_sale'] = $request->has('availabe_for_sale');
            
            $product = $this->productService->createProduct($data, $request->user()->id);

            return response()->json([
                'message' => 'Product created successfully',
                'data' => $product,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create product',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update a product
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        try {

            $data = $request->validated();
            $data['availabe_for_sale'] = $request->has('availabe_for_sale');
            
            $product = $this->productService->updateProduct($product, $data);

            return response()->json([
                'message' => 'Product updated successfully',
                'data' => $product,
            ]);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 403);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update product',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete a product
     */
    public function destroy(Product $product): JsonResponse
    {
        try {

            $this->productService->deleteProduct($product);

            return response()->json([
                'message' => 'Product deleted successfully',
            ]);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 403);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete product',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}

