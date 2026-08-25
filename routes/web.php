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

// Dynamic Sitemap for Google Search Console & SEO
Route::get('/sitemap.xml', function () {
    $lastProject = \App\Models\Project::latest('updated_at')->first();
    $lastCert = \App\Models\Certificate::latest('updated_at')->first();

    $projectUpdated = $lastProject ? $lastProject->updated_at : now();
    $certUpdated = $lastCert ? $lastCert->updated_at : now();
    $lastmod = ($projectUpdated > $certUpdated ? $projectUpdated : $certUpdated)->toAtomString();

    $siteUrl = config('app.url') !== 'http://localhost' && config('app.url') !== 'http://porto-new.test'
        ? config('app.url')
        : 'https://portfolio.satcloud.tech';

    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    $xml .= '  <url>' . "\n";
    $xml .= '    <loc>' . htmlspecialchars($siteUrl) . '</loc>' . "\n";
    $xml .= '    <lastmod>' . $lastmod . '</lastmod>' . "\n";
    $xml .= '    <changefreq>weekly</changefreq>' . "\n";
    $xml .= '    <priority>1.0</priority>' . "\n";
    $xml .= '  </url>' . "\n";
    $xml .= '</urlset>';

    return response($xml, 200)->header('Content-Type', 'text/xml; charset=utf-8');
})->name('sitemap');

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
