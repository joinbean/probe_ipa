<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\TrophyController;
use App\Http\Controllers\TypeController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/colors', [ColorController::class, 'index']);

Route::get('/types', [TypeController::class, 'index']);

Route::resource('categories', CategoryController::class)->only([
    'index', 'store', 'show', 'update', 'destroy'
])->middleware('auth:sanctum')->missing(function () {
    return response()->json(["message" => "The given data was invalid.", "errors" => ["category_id" => ["The selected category id is invalid."]]], 422);
});

Route::get('/trophies/sortByDate', [TrophyController::class, 'sortByDate']);
Route::get('/trophies/sortByRank', [TrophyController::class, 'sortByRank']);

Route::get('/trophies/filterByType/{type:id}', [TrophyController::class, 'filterByType'])->missing(function () {
    return response()->json(["message" => "The given data was invalid.", "errors" => ["category_id" => ["The selected type id is invalid."]]], 422);
});
Route::get('/trophies/filterByRank/{rank_value}', [TrophyController::class, 'filterByRank']);
Route::get('/trophies/filterByCategory/{category:id}', [TrophyController::class, 'filterByCategory'])->missing(function () {
    return response()->json(["message" => "The given data was invalid.", "errors" => ["category_id" => ["The selected category id is invalid."]]], 422);
});

Route::resource('trophies', TrophyController::class)->only([
    'index', 'store', 'show', 'update', 'destroy'
])->middleware('auth:sanctum')->missing(function () {
    return response()->json(["message" => "The given data was invalid.", "errors" => ["trophy_id" => ["The selected trophy id is invalid."]]], 422);
});
