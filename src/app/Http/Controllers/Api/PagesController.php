<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutAchievements;
use App\Models\AboutUs;
use App\Models\Pages;

class PagesController extends Controller
{
  public function index()
  {
    // $pages=[];
    // $pages = AboutUs::all();
    // foreach($pages as $page):
    //   $pages = AboutAchievements::where('about_achievementable_id',  $page->id)->get();
    // endforeach;

    // return $pages;
  }
}
