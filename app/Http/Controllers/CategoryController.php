<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function getAll()
    {
        $categories = Category::all();
        return response()->json([
            'is_success' => true,
            'data' => $categories
        ], 200);
    }

    public function getOne(int $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'is_success' => false,
                'data' => null
            ], 404);
        }

        return response()->json([
            'is_success' => true,
            'data' => $category
        ], 200);
    }

    public function create(Request $request)
    {
        $request->validate(Category::rules());
        $category = Category::create(request()->all());
        if ($category) {
            return response()->json([
                'is_success' => true,
                'data' => $category
            ], 200);
        }

        return response()->json([
            'is_success' => false,
            'data' => null
        ], 500);
    }

    public function update(Request $request, int $id)
    {
        $request->validate(Category::rules());
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'is_success' => false,
                'data' => null
            ], 404);
        }

        $category->update($request->all());
        return response()->json([
            'is_success' => true,
            'data' => $category
        ], 200);
    }

    public function delete(int $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'is_success' => false,
                'data' => null
            ], 404);
        }

        $category->delete();
        return response()->json([
            'is_success' => true,
            'data' => null
        ], 204);
    }
}
