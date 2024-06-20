<?php

use App\Http\Controllers\VideoController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\AuthTvMiddleware;
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

Route::middleware([AuthMiddleware::class])->prefix('rockola')->group(function () {
    Route::get('videos', [VideoController::class, 'getAll']);
    Route::get('playlist', [VideoController::class, 'getSalaPlaylist']);
    Route::get('search', [VideoController::class, 'searchVideos']);
    Route::post('add-video', [VideoController::class, 'addVideo']);
});

Route::middleware([AuthTvMiddleware::class])->prefix('sala')->group(function () {
    Route::get('playlist/last-video', [VideoController::class, 'getLastVideo']);
    Route::delete('playlist/{id}', [VideoController::class, 'deleteVideoPlaylist']);
});
