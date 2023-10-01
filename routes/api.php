<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\VideosController;
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

Route::apiResource('videos', 'App\Http\Controllers\VideosController');
Route::apiResource('categorias', 'App\Http\Controllers\CategoriasController');

Route::get('categorias/{id}/videos', [CategoriasController::class, 'showVideosToCategory']);
Route::get('videos/', [VideosController::class, 'showByTitle']);
