<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Http\Resources\AboutUsResource;
class AboutUsController extends Controller
{
    public function index()
    {
        $about_us =  AboutUsResource::collection(AboutUs::all());
        return response()->json($about_us);
    }
}
