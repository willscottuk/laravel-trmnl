<?php

use Bnussbau\LaravelTrmnl\Http\Controllers\TrmnlHttpController;
use Illuminate\Support\Facades\Route;

if (config('trmnl.plugin_type') === 'public') {
    Route::prefix('trmnl')->group(function () {
        Route::get('/', [TrmnlHttpController::class, 'index'])->name('trmnl.index');
        Route::get('/auth/create', [TrmnlHttpController::class, 'create'])->name('trmnl.auth.create');
        Route::post('/auth/install', [TrmnlHttpController::class, 'install'])->name('trmnl.auth.install');
        Route::post('/auth/destroy', [TrmnlHttpController::class, 'destroy'])->name('trmnl.auth.destroy');
        Route::get('/manage', [TrmnlHttpController::class, 'manage'])->name('trmnl.manage');
        Route::get('/docs', [TrmnlHttpController::class, 'docs'])->name('trmnl.docs');
    });
}
