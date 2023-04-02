<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use App\Models\Pages;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
  public function index()
  {
    $pages = Contacts::find(1);
    $pages = $pages->social;

    return response()->json($pages);
  }
}
