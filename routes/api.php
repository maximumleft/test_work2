<?php

use App\Http\Controllers\FavoriteMovieController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::Resource('users', UserController::class);


Route::group(['namespace' => 'Movies', 'prefix' => 'movies'], function () {
    Route::get('/', [MovieController::class, 'index']);
    Route::post('/favorites/{movie}', [FavoriteMovieController::class, 'addToFavorites']);
    Route::delete('/favorites/{movie}', [FavoriteMovieController::class, 'removeFromFavorites']);
    Route::get('/not-favorites/{user}', [FavoriteMovieController::class, 'notFavorites']);
    });
