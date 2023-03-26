<?php

namespace App\Http\Controllers;

use App\Models\Pages;

class PagesController extends Controller
{
  public function index()
  {
    $pages = Pages::all();
    return response()->json($pages);
  }
}
