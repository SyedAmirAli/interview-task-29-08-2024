<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categories()
    {
        $categories = Category::latest('id')->get();

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
        $request->validate(['category_name' => 'required|unique:categories,name']);
        $name = $request->input('category_name');

        if ($category = Category::create(compact('name'))) {
            return response()->json([
                'status' => 'success',
                'message' => 'New category added successfully!',
                'data' => $category
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to add category!'
        ], 400);
    }

    public function update(Request $request, string|int $id)
    {
        $category = Category::find($id);

        $request->validate(['category_name' => 'required']);
        $name = $request->input('category_name');

        if (Category::whereNot('id', $id)->where('name', $name)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'The category name has already been taken!'
            ], 400);
        }

        $category->name = $name;

        if ($category->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Category name updated successfully!',
                'data' => $category
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to update category!'
        ], 400);
    }

    public function delete(string|int $id)
    {
        $category = Category::with('products')->findOrFail($id);

        foreach ($category->products as $key => $product) {
            if ($product->categories()->count() == 1) {
                if (file_exists($product->image)) unlink($product->image);
                $product->delete();
            } else {
                $product->categories()->detach($category->id);
            }
        }

        if ($category->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Category with products deleted successfully!',
                'data' => []
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to delete category!'
        ], 400);
    }
}
