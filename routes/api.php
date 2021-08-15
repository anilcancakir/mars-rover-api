<?php

use App\Http\Controllers\Api\PlateauController;
use App\Http\Controllers\Api\RoverController;
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

Route::post('plateaus/create', [PlateauController::class, 'store']);
Route::get('plateaus/{id}', [PlateauController::class, 'show']);
Route::post('rovers/create', [RoverController::class, 'store']);
Route::get('rovers/{id}', [RoverController::class, 'show']);
