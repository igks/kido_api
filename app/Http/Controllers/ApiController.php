<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ReqLogs;
use App\Models\Title;
use App\Models\Content;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

        try {
            ReqLogs::create([
                'date' => Carbon::now(),
                'counter' => 1,
                'title_id' => $titleId
            ]);
        } catch (\Throwable $th) {
        }

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

        try {
            ReqLogs::create([
                'date' => Carbon::now(),
                'counter' => 1,
                'title_id' => $content->title_id
            ]);
        } catch (\Throwable $th) {
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

    public function reqLog()
    {
        $raws = ReqLogs::where('date', '>', Carbon::now()->subDays(30))
            ->get()
            ->groupBy('date')->map(function ($row) {
                return $row->sum('counter');
            });

        $result = [];
        foreach ($raws as $key => $value) {
            $result[] = [
                'date' => $key,
                'value' => $value
            ];
        }

        return response()->json([
            'is_success' => true,
            'data' => $result
        ], 200);
    }

    public function topRequest()
    {
        $raws = ReqLogs::all()
            ->groupBy('title_id')->map(function ($row) {
                return $row->sum('counter');
            })
            ->sortByDesc(function ($value, $key) {
                return $value;
            })
            ->take(5);

        $result = [];
        foreach ($raws as $key => $value) {
            $result[] = Title::getName($key);
        }

        return response()->json([
            'is_success' => true,
            'data' => $result
        ], 200);
    }
}
