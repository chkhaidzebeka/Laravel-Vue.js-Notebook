<?php

use App\Http\Controllers\ArticlesController;
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


Route::prefix('/v1/article')->group(function(){
	Route::get('/all',[ArticlesController::class,'index']);
	Route::post('/new',[ArticlesController::class,'store']);
	Route::put('/{id}',[ArticlesController::class,'update']);
	Route::delete('/{id}',[ArticlesController::class,'destroy']);
});



