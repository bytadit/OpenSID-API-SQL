<?php

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

Route::apiResource('/bloodtypes', App\Http\Controllers\Api\BloodTypeController::class);
Route::apiResource('/populations', App\Http\Controllers\Api\PopulationController::class);
Route::apiResource('/pemilih', App\Http\Controllers\Api\PemilihController::class);
