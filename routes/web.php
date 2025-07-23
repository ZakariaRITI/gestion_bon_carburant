<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Exports\BonsExport;
use Maatwebsite\Excel\Facades\Excel;
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
Route::get('/impression/{type}', [AdminController::class, 'impression']);
Route::get('/impression-site-pdf/{type}', [AdminController::class, 'pdf']);
Route::get('/impression-bon-pdf', [AdminController::class, 'pdf_recherche_nbon']);
Route::get('/impression-matricule-pdf', [AdminController::class, 'pdf_recherche_nmatricule']);
Route::get('/impression-vehicule-pdf', [AdminController::class, 'pdf_recherche_nvehicule']);
Route::get('/impression-acc-pdf', [AdminController::class, 'pdf_acc']);
Route::get('/export-excel', [AdminController::class, 'exportExcelBon']);
Route::get('/export-excel_service', [AdminController::class, 'exportExcelservice']);
Route::get('/export-excel_vehicule', [AdminController::class, 'exportExcelvehicule']);
Route::get('/export-excel_preneur', [AdminController::class, 'exportExcelpreneur']);
Route::get('/export-excel_journee', [AdminController::class, 'exportExceljournee']);
Route::get('/export-excel_nbon', [AdminController::class, 'exportExcelnbon']);
Route::get('/export-excel_nmatricule', [AdminController::class, 'exportExcelnmatricule']);
Route::get('/export-excel_nvehicule', [AdminController::class, 'exportExcelnvehicule']);
Route::get('/export-excel_acc', [AdminController::class, 'exportExcelacc']);
Route::get('/as',[AdminController::class,'ajoutsite']);
Route::post('/aa',[AdminController::class,'savesite']);
Route::get('/ds',[AdminController::class,'displaysite']);
Route::get('/update',[AdminController::class,'updatesite']);
Route::post('/saveupdate',[AdminController::class,'saveupdatesite']);
Route::get('/delete',[AdminController::class,'deletesite']);
Route::get('/aservice',[AdminController::class,'ajoutservice']);
Route::post('/ajservice',[AdminController::class,'saveservice']);

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
