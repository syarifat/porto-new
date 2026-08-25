<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\AIChatController;
use Illuminate\Support\Facades\Route;

// Landing page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Project Timeline page
Route::get('/proyek', [HomeController::class, 'timeline'])->name('projects.timeline');


// AI Chat API
Route::post('/api/chat', [AIChatController::class, 'chat'])->name('api.chat');

// Admin Auth
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Projects
        Route::resource('projects', ProjectController::class)->except(['show']);

        // Certificates
        Route::post('certificates/reorder', [CertificateController::class, 'reorder'])->name('certificates.reorder');
        Route::resource('certificates', CertificateController::class)->except(['show']);
    });
});
