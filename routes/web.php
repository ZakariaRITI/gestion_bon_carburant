<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/acc',[AdminController::class,'display']);
Route::get('/ab',[AdminController::class,'ajoutbon']);
Route::get('/save',[AdminController::class,'enregistrer']);
Route::get('/pc',[AdminController::class,'prixcarburant']);
Route::get('/pcs',[AdminController::class,'modifiercarburant']);
Route::get('/profile',[AdminController::class,'profile']);
Route::get('/searchb',[AdminController::class,'recherche_nbon']);
Route::get('/searchm',[AdminController::class,'recherche_nmatricule']);
Route::get('/searchv',[AdminController::class,'recherche_nvehicule']);
Route::get('/update',[AdminController::class,'update_bon']);
Route::post('/modifier',[AdminController::class,'modifier_bon']);
Route::get('/delete',[AdminController::class,'supprimer_bon']);

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
});

require __DIR__.'/auth.php';
