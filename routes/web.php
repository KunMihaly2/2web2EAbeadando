<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Controllers\HajoController;
use App\Http\Controllers\KapcsolatController;

Route::view('/', 'fooldal')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::view('/kapcsolat', 'kapcsolat')->name('kapcsolat');

Route::post('/kapcsolat', [KapcsolatController::class, 'store'])
    ->name('kapcsolat.store');

Route::get('/uzenetek', [KapcsolatController::class, 'index'])
    ->middleware('auth')
    ->name('uzenetek');


Route::get('/admin', function () {
    return 'Admin felület – sikeres belépés.';
})->middleware(['auth', EnsureUserIsAdmin::class])->name('admin');

Route::get('/adatbazis', [HajoController::class, 'index'])
    ->name('adatbazis');

Route::get('/diagram', [HajoController::class, 'diagram'])
    ->name('diagram');

    
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';


