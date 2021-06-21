<?php

use App\Http\Controllers\Admin\LayerController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\MapController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
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

    Route::prefix("layers")->name("layers.")->group(function () {
        Route::get('deleted', [LayerController::class, 'deleted'])->name('deleted');
        Route::get('restore/{layer}', [LayerController::class, 'restore'])->name('restore');
    });

    Route::resource('layers', LayerController::class);

    Route::prefix('managers')->name('managers.')->group(function () {
        Route::get('deleted', [ManagerController::class, 'deleted'])->name('deleted');
        Route::get('restore/{manager}', [ManagerController::class, 'restore'])->name('restore');
    });

    Route::resource('managers', ManagerController::class);

    Route::prefix('map')->name('map.')->group(function () {
        Route::get('', [MapController::class, 'index'])->name('index');
        Route::post('store', [MapController::class, 'store'])->name('store');
        Route::post('update', [MapController::class, 'update'])->name('update');
        Route::post('destroy', [MapController::class, 'destroy'])->name('destroy');

    });
});

