<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductStoreRequest;
use App\Http\Requests\Api\ProductUpdateRequest;

class ProductController extends Controller
{
    public function getProducts()
    {
        $products = Product::with('category')->with('status')->get();
        return response()->json($products);
    }
    public function getProduct($id)
    {
        $product =Product::with('category')->with('status')->where('id',$id)->first();;
        return response()->json($product);
    }
    public function addProduct(ProductStoreRequest $request)
    {
        Product::create($request->validated());
        return response()->json(
            [
                'message' => 'product Added successfully'
            ],
            200
        );
    }
    public function updateProduct(ProductUpdateRequest $request, $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->update($request->validated());
            return response()->json(
                [
                    'message' => 'product Updated successfully'
                ],
                200
            );
        }
        return response()->json(['message' => 'product NotFound'], 404);
    }
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json(['message' => 'Product Deleted successfully']);
        }
        return response()->json(['message' => 'Product NotFound'], 404);
    }
}
