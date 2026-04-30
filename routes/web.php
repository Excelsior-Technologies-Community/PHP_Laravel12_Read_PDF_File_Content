<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;

Route::get('/', function () {
    return redirect('/pdfs');
});

Route::get('/pdfs', [PdfController::class, 'index']);
Route::post('/pdfs/upload', [PdfController::class, 'store']);
Route::get('/pdf/read/{id}', [PdfController::class, 'read']);
Route::get('/pdf/view/{id}', [PdfController::class, 'view']);
Route::get('/pdf/download/{id}', [PdfController::class, 'download']);