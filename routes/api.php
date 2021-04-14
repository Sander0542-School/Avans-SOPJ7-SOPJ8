<?php

use App\Http\Controllers\Api\LayerController;
use App\Http\Controllers\Api\SubjectController;
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

Route::apiResource('layers', LayerController::class)->only(['index', 'show']);
Route::apiResource('subjects', SubjectController::class)->only(['index', 'show']);
