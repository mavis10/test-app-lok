<?php

use App\Http\Controllers\API\LanguageController;
use App\Http\Controllers\API\LoginController;
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


Route::post('/authenticate', [LoginController::class, 'authenticate']);

Route::middleware('auth:sanctum')->group( function () {
    Route::get('/languages', [LanguageController::class, 'index']);
});