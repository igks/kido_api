<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Title;
use App\Models\Content;

class ApiController extends Controller
{
    public function categories(Request $request)
    {
        $categories = Category::all();
        return response()->json([
            'is_success' => true,
            'data' => $categories
        ], 200);
    }

    public function titleByCategory($categoriesId)
    {
        $titles = Title::where('category_id', $categoriesId)->get();
        return response()->json([
            'is_success' => true,
            'data' => $titles
        ], 200);
    }

    public function contentByTitle($titleId)
    {
        $contents = Content::where('title_id', $titleId)->get();
        return response()->json([
            'is_success' => true,
            'data' => $contents
        ], 200);
    }

    public function contentById($id)
    {
        $content = Content::find($id);
        if ($content == null) {
            return response()->json([
                'is_success' => false,
                'data' => null
            ], 404);
        }

        return response()->json([
            'is_success' => true,
            'data' => $content
        ], 200);
    }

    public function favorites(Request $request)
    {
        $params = $request->input('params');
        $favorites = explode(",", $params);
        $contents = Content::whereIn('id', $favorites)->get();
        return response()->json([
            'is_success' => true,
            'data' => $contents
        ], 200);
    }

    public function search(Request $request)
    {
        $params = $request->input('params');
        $contents = Content::query()
            ->where('content', 'LIKE', "%{$params}%")
            ->orWhere('meaning', 'LIKE', "%{$params}%")
            ->orWhere('description', 'LIKE', "%{$params}%")
            ->get();
        return response()->json([
            'is_success' => true,
            'data' => $contents
        ], 200);
    }
}
