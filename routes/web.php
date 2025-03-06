<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CharacterCheckController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route untuk halaman check karakter
    Route::get('/character-check', [CharacterCheckController::class, 'showCheckForm'])->name('character.check');

    // Route untuk submit form check karakter
    Route::post('/character-check', [CharacterCheckController::class, 'checkCharacters'])->name('character.check.submit');

    // Route untuk halaman history check karakter
    Route::get('/character-history', [CharacterCheckController::class, 'showHistory'])->name('character.history');

    // routes/web.php
    Route::delete('/history/{id}', [CharacterCheckController::class, 'destroy'])->name('history.destroy');

    // route untuk halaman dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});



require __DIR__ . '/auth.php';
