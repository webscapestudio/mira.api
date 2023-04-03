<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pages;

class PagesController extends Controller
{
  public function index()
  {
    $pages = Pages::all();
    return response()->json($pages);
  }
}
