<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
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
        Route::get('', [MenuController::class, 'index'])->name('getIndex');
        Route::get('edit', [MenuController::class, 'edit'])->name('getEdit');

        Route::post('update', [MenuController::class, 'update'])->name('postUpdate');
    });
});
