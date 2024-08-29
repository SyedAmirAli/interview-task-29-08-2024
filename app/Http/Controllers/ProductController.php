<?php

namespace App\Http\Controllers;

use App\Helper\Resources;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products()
    {
        $categories = Product::with(['categories', 'features'])->latest('id')->get();

        if ($categories) {
            return response()->json([
                'status' => 'success',
                'message' => 'Category get successfully!',
                'data' => $categories
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Server Error!'
        ], 500);
    }

    public function store(Request $request)
    {

        $request->validate(['product_name' => 'required', 'product_image' => 'required|image|max:5000',]);

        $productCategories = [];
        if ($request->input('product_categories')) {
            $productCategories = json_decode($request->input('product_categories'), true);
        }

        $name = $request->input('product_name');
        $image = Resources::saveFile($request, 'product_image');

        $product = Product::create(compact('name', 'image'));

        if (!empty($productCategories)) {
            $categoryIds = array_column($productCategories, 'id');
            $product->categories()->attach($categoryIds);
        }

        if ($product) {
            return response()->json([
                'status' => 'success',
                'message' => 'New product added successfully!',
                'data' => Product::with(['categories', 'features'])->find($product->id),
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to add product!'
        ], 400);
    }

    public function update(Request $request, string|int $id)
    {
        $request->validate(['product_name' => 'required', 'product_image' => 'required']);

        $product = Product::find($id);
        $name = $request->input('product_name');

        $image = Resources::saveFile($request, oldPath: $product->image);
        $product->name = $name;
        if ($image) $product->image = $image;


        if ($product->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product name updated successfully!',
                'data' => $product
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to update Product!'
        ], 400);
    }

    public function delete(string|int $id)
    {
        $product = Product::find($id);

        if ($product->delete()) {
            if (file_exists($product->image)) unlink($product->image);

            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted successfully!',
                'data' => []
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to delete product!'
        ], 400);
    }

    // store product's feature
    public function storeFeature(Request $request, string|int $productId)
    {
        $request->validate(['feature_description' => 'required']);

        $description = $request->input('feature_description');
        $featureProduct = Feature::create(['description' => $description, 'product_id' => $productId]);

        if ($featureProduct) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product feature added successfully!',
                'data' => $featureProduct
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to add product feature!'
        ], 400);
    }
}
