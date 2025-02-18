<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\LocataireController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ContratTemplateController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ImpotController;
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

    // Routes des locataires
    Route::get('/locataires', [LocataireController::class, 'index'])->name('locataires.index');
    Route::get('/locataires/create', [LocataireController::class, 'create'])->name('locataires.create');
    Route::post('/locataires', [LocataireController::class, 'store'])->name('locataires.store');
    Route::get('/locataires/{locataire}/edit', [LocataireController::class, 'edit'])->name('locataires.edit');
    Route::put('/locataires/{locataire}', [LocataireController::class, 'update'])->name('locataires.update');
    Route::delete('/locataires/{locataire}', [LocataireController::class, 'destroy'])->name('locataires.destroy');

    // Routes des locations
    Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
    Route::get('/locations/create', [LocationController::class, 'create'])->name('locations.create');
    Route::post('/locations', [LocationController::class, 'store'])->name('locations.store');
    Route::get('/locations/{location}/edit', [LocationController::class, 'edit'])->name('locations.edit');
    Route::put('/locations/{location}', [LocationController::class, 'update'])->name('locations.update');
    Route::delete('/locations/{location}', [LocationController::class, 'destroy'])->name('locations.destroy');

    // Routes des templates de contrat
    Route::get('/contrat-templates', [ContratTemplateController::class, 'index'])->name('contrat-templates.index');
    Route::get('/contrat-templates/create', [ContratTemplateController::class, 'create'])->name('contrat-templates.create');
    Route::post('/contrat-templates', [ContratTemplateController::class, 'store'])->name('contrat-templates.store');
    Route::delete('/contrat-templates/{template}', [ContratTemplateController::class, 'destroy'])->name('contrat-templates.destroy');
    Route::get('/locations/{location}/generate-contrat', [ContratTemplateController::class, 'showTemplateSelection'])->name('contrat-templates.select');
    Route::post('/locations/{location}/generate-contrat/{template}', [ContratTemplateController::class, 'generateContrat'])->name('contrat-templates.generate');
    Route::get('/contrat-templates/{template}/edit', [ContratTemplateController::class, 'edit'])->name('contrat-templates.edit');
    Route::put('/contrat-templates/{template}', [ContratTemplateController::class, 'update'])->name('contrat-templates.update');
    Route::get('/locations/{location}/download-contrat/{template}', [ContratTemplateController::class, 'generateContratPdf'])->name('contrat-templates.download');

    // Routes des paiements
    Route::get('/locations/{location}/paiements', [PaiementController::class, 'index'])->name('paiements.index');
    Route::put('/paiements/{paiement}', [PaiementController::class, 'update'])->name('paiements.update');

    // Routes des factures
    Route::get('/factures/{paiement}', [FactureController::class, 'generate'])->name('factures.generate');

    // Routes des impôts
    Route::get('/impots', [ImpotController::class, 'index'])->name('impots.index');
    Route::get('/impots/export/{annee}', [ImpotController::class, 'exportPdf'])->name('impots.export');
});

require __DIR__.'/auth.php';
