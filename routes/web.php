<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/surat/{shortCode}', [SuratController::class, 'cetak'])->name('surat.cetak');
Route::get('/verify/{shortCode}', [SuratController::class, 'verify'])->name('surat.verify');
Route::get('/surat/{shortCode}/download', [SuratController::class, 'download'])->name('surat.download');

Route::get('/download', [SuratController::class, 'downloadPage'])->name('surat.download.page');
Route::post('/download', [SuratController::class, 'downloadSubmit'])->name('surat.download.submit');

Route::get('/surat/{shortCode}/pdf', [SuratController::class, 'downloadPdf'])->name('surat.pdf');


