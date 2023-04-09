<?php

use App\Http\Controllers\Api\AboutUsController;
use App\Http\Controllers\Api\AchievementsController;
use App\Http\Controllers\Api\BannersController;
use App\Http\Controllers\Api\GeneralRequestsController;
use App\Http\Controllers\Api\ResumeRequestsController;
use App\Http\Controllers\Api\AdvantagesController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\ManifestoController;
use App\Http\Controllers\Api\PartnersController;
use App\Http\Controllers\Api\InvestingController;
use App\Http\Controllers\Api\InvestAdvantagesController;
use App\Http\Controllers\Api\InvestStrategiesController;
use App\Http\Controllers\Api\ContactsController;
use App\Http\Controllers\Api\NewsController as ApiNewsController;
use App\Http\Controllers\Api\NewsSingleController;
use App\Http\Controllers\Api\Pages\MainController;
use App\Http\Controllers\Api\Pages\InvestitionsController;
use App\Http\Controllers\Api\Pages\NewsController;
use App\Http\Controllers\Api\Pages\OurProjectsController;
use App\Http\Controllers\Api\Pages\WorkWithUsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware("auth:sanctum")->get("/user", function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'general_request' => GeneralRequestsController::class,
    'resume_request' => ResumeRequestsController::class,
    'banners' => BannersController::class,
    'achievements' => AchievementsController::class,
    'about' => AboutUsController::class,
    'advantages' => AdvantagesController::class,
    'history' => HistoryController::class,
    'manifesto' => ManifestoController::class,
    'partners' => PartnersController::class,
    'investitions/main' => InvestingController::class,
    'investitions/advantages' => InvestAdvantagesController::class,
    'investitions/strategies' => InvestStrategiesController::class,
    'news' => ApiNewsController::class,
    'vacancies' => ContactsController::class,
    'page/main' => MainController::class,
    'page/investitions' => InvestitionsController::class,
    'page/our-projects' => OurProjectsController::class,
    'page/work-with-us' => WorkWithUsController::class,
    'page/news' => NewsController::class,
    // 'page/vacancies' => ContactsController::class,
    // 'news/{news_slug}' => ContactsController::class,

]);

