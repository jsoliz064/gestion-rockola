<?php

use App\Http\Controllers\PedidoController;
use App\Http\Controllers\VideoController;
use App\Http\Middleware\AuthMiddleware;
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

Route::middleware([AuthMiddleware::class])->prefix('rockola')->group(function () {
    Route::get('videos', [VideoController::class, 'getAll']);
    Route::get('search', [VideoController::class, 'searchVideos']);
    Route::get('add-video', [VideoController::class, 'addVideo']);
});
