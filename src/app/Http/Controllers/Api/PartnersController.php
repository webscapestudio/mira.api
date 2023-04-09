<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partners;
use App\Http\Resources\PartnersResource;

class PartnersController extends Controller
{
    public function index()
    {
        $partners = PartnersResource::collection(Partners::all());
        return response()->json($partners);
    }
}
