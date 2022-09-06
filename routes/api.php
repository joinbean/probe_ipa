<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrophyController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('categories', CategoryController::class)->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

Route::resource('trophies', TrophyController::class)->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

Route::get('/trophies/sortByDate', [TrophyController::class, 'sortByDate']);
Route::get('/trophies/sortByRank', [TrophyController::class, 'sortByRank']);

Route::get('/trophies/filterByType/{type}', [TrophyController::class, 'filterByType']);
Route::get('/trophies/filterByRank/{rank}', [TrophyController::class, 'filterByRank']);
Route::get('/trophies/filterByCategory/{category}', [TrophyController::class, 'filterByCategory']);
