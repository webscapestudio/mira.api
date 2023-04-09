<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\AdvantagesResource;
use App\Models\Advantages;
class AdvantagesController extends Controller
{
    public function index()
    {
        $advantages = AdvantagesResource::collection(Advantages::all());
        return response()->json($advantages);
    }
}