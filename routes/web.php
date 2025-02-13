<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\LocataireController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes des boxes
    Route::get('/boxes', [BoxController::class, 'index'])->name('boxes.index');
    Route::get('/boxes/create', [BoxController::class, 'create'])->name('boxes.create');
    Route::post('/boxes', [BoxController::class, 'store'])->name('boxes.store');
    Route::get('/boxes/{box}/edit', [BoxController::class, 'edit'])->name('boxes.edit');
    Route::put('/boxes/{box}', [BoxController::class, 'update'])->name('boxes.update');
    Route::delete('/boxes/{box}', [BoxController::class, 'destroy'])->name('boxes.destroy');

    Route::get('/locataire', [LocataireController::class, 'index'])->name('locataire.index');
    Route::get('/locataire/create', [LocataireController::class, 'create'])->name('locataire.create');
    Route::post('/locataire', [LocataireController::class, 'store'])->name('locataire.store');
    Route::get('/locataire/{locataire}/edit', [LocataireController::class, 'edit'])->name('locataire.edit');
    Route::put('/locataire/{locataire}', [LocataireController::class, 'update'])->name('locataire.update');
    Route::delete('/locataire/{locataire}', [LocataireController::class, 'destroy'])->name('locataire.destroy');
});

require __DIR__.'/auth.php';
