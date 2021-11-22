<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Title;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function getByTitle(int $id)
    {
        $contents = Content::where('title_id', $id)->get();
        $id = $id;
        $title = Title::find($id);
        return response()->json([
            'is_success' => true,
            'data' => [
                'content' => $contents,
                'title' => $title,
                'id' => $id
            ]
        ], 200);
    }

    public function getOne(int $id)
    {
        $content = Content::find($id);
        if (!$content) {
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

    public function create(Request $request)
    {
        $request->validate(Content::rules());
        $content = Content::create(request()->all());
        if ($content) {
            return response()->json([
                'is_success' => true,
                'data' => $content
            ], 200);
        }

        return response()->json([
            'is_success' => false,
            'data' => null
        ], 500);
    }

    public function update(Request $request, int $id)
    {
        $request->validate(Content::rules());
        $content = Content::find($id);
        if (!$content) {
            return response()->json([
                'is_success' => false,
                'data' => null
            ], 404);
        }

        $content->update($request->all());
        return response()->json([
            'is_success' => true,
            'data' => $content
        ], 200);
    }

    public function delete(int $id)
    {
        $content = Content::find($id);
        if (!$content) {
            return response()->json([
                'is_success' => false,
                'data' => null
            ], 404);
        }

        $content->delete();
        return response()->json([
            'is_success' => true,
            'data' => null
        ], 204);
    }
}
