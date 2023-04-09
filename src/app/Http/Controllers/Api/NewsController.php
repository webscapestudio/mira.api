<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Http\Resources\NewsResource;
use App\Http\Resources\NewsSingleResource;

class NewsController extends Controller
{
    public function index()
    {
        $news = NewsResource::collection(News::paginate(10));
        return response()->json([
            'news' => $news,
        ]);
    }
    public function show($slug)
    {
        $news = NewsSingleResource::collection(News::where('slug',$slug)->get());
        return response()->json([
            'news' => $news,
        ]);
    }
}
