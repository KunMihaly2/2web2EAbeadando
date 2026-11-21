<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Middleware\EnsureUserIsAdmin;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::get('/admin', function () {
    return 'Admin felület – sikeres belépés.';
})->middleware(['auth', EnsureUserIsAdmin::class])->name('admin');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
