<?php

use App\Http\Controllers\Admin\LayerController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\MapController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::prefix('admin')->middleware(['auth:sanctum', 'verified'])->name('admin.')->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('menu')->name('menu.')->group(function () {
        Route::get('', [MenuController::class, 'index'])->name('index');
        Route::post('update', [MenuController::class, 'update'])->name('update');
    });

    Route::resource('layers', LayerController::class)->only(['index', 'create', 'edit', 'store', 'update']);

    Route::prefix('managers')->name('managers.')->group(function () {
        Route::get('deleted', [ManagerController::class, 'deleted'])->name('deleted');
        Route::get('restore/{manager}', [ManagerController::class, 'restore'])->name('restore');
    });

    Route::resource('managers', ManagerController::class);

    Route::prefix('map')->name('map.')->group(function () {
        Route::get('', [MapController::class, 'index'])->name('index');
        Route::post('update', [MapController::class, 'update'])->name('update');
    });
});

