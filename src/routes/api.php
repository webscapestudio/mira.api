<?php

use App\Http\Controllers\Api\GeneralRequestsController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\PagesController;
use App\Http\Controllers\Api\ResumeRequestsController;
use App\Orchid\Screens\Requests\ResumeRequestsListScreen;
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
    'main' => MainController::class,
]);
// Route::get('pages',[
//     GeneralRequestsController::class
// ]);