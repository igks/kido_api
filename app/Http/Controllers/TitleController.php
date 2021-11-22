<?php

namespace App\Http\Controllers;

use App\Models\Title;
use Illuminate\Http\Request;

class TitleController extends Controller
{

    public function getByCategory(int $id)
    {
        $titles = Title::where('category_id', $id)->get();
        return response()->json([
            'is_success' => true,
            'data' => $titles
        ], 200);
    }

    public function getOne(int $id)
    {
        $title = Title::find($id);
        if (!$title) {
            return response()->json([
                'is_success' => false,
                'data' => null
            ], 404);
        }

        return response()->json([
            'is_success' => true,
            'data' => $title
        ], 200);
    }

    public function create(Request $request)
    {
        $request->validate(Title::rules());
        $title = Title::create(request()->all());
        if ($title) {
            return response()->json([
                'is_success' => true,
                'data' => $title
            ], 200);
        }

        return response()->json([
            'is_success' => false,
            'data' => null
        ], 500);
    }

    public function update(Request $request, int $id)
    {
        $request->validate(Title::rules());
        $title = Title::find($id);
        if (!$title) {
            return response()->json([
                'is_success' => false,
                'data' => null
            ], 404);
        }

        $title->update($request->all());
        return response()->json([
            'is_success' => true,
            'data' => $title
        ], 200);
    }

    public function delete(int $id)
    {
        $title = Title::find($id);
        if (!$title) {
            return response()->json([
                'is_success' => false,
                'data' => null
            ], 404);
        }

        $title->delete();
        return response()->json([
            'is_success' => true,
            'data' => null
        ], 204);
    }
}
