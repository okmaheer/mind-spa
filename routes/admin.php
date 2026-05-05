<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ToolController;
use Illuminate\Support\Facades\Route;

// Login / logout — outside auth middleware to prevent redirect loops
// throttle:5,1 = max 5 login attempts per minute per IP
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login',   [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',  [AuthController::class, 'login'])->name('login.submit')->middleware('throttle:5,1');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Protected admin routes
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/tools',                       [ToolController::class, 'index'])->name('tools.index');
    Route::post('/tools/{id}/publish',   [ToolController::class, 'publish'])->name('tools.publish');
    Route::post('/tools/{id}/unpublish', [ToolController::class, 'unpublish'])->name('tools.unpublish');
    Route::post('/tools/{id}/schedule',  [ToolController::class, 'schedule'])->name('tools.schedule');
});
