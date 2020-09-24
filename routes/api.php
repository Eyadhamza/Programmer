<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TrackController;
use App\Http\Resources\SectionResource;
use App\Models\Section;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tracks',[TrackController::class,'index']);
Route::get('/tracks/{track}',[TrackController::class,'show']);


Route::get('/languages',[LanguageController::class,'index']);
Route::get('/languages/{track}',[LanguageController::class,'show']);


Route::get('/sections',function (){
    $sections=Section::all();
   return SectionResource::collection($sections);
});

