<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function firstProduct($id)
    {
        $product = Product::where('id', $id)->first();

        if (!$product) {
            return response()->json([
                'message' => '404 not found'
            ]);
        }

        return response()->json($product);
    }

    public function getProducts()
    {
        $products = Product::get();

        return response()->json($products);
    }

    public function createProduct(Request $request) 
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png']
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'image' => $path,
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price']
        ]);

        return response()->json([
            'message' => 'Product created successfully'
        ]);
    }

    // public function deleteProduct($id)
    // {
    //     $product = Product::find($id);

    //     if (!$product) {
    //         return response()->json([
    //             'message' => '404 not found'
    //         ]);
    //     }

    //     $product->delete();

    //     return response()->json([
    //         'message' => 'Product soft deleted successfully'
    //     ]);
    // }
}
