<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/pdfs', [PdfController::class, 'index']);
Route::get('/pdf/view/{id}', [PdfController::class, 'view']);
Route::get('/pdf/download/{id}', [PdfController::class, 'download']);

