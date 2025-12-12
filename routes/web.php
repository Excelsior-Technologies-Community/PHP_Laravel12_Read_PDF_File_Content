<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group
| which contains the "web" middleware group. Now create something great!
|
*/

// Step 1: Define a GET route for reading PDF content.
// 'read-pdf-file' is the URL path that users will visit in the browser.
// Example URL: http://localhost:8000/read-pdf-file

// Step 2: Specify the controller and method to handle this route.
// [PDFController::class, 'index'] tells Laravel to use the 'index' method
// of the PDFController when someone visits this URL.

Route::get('read-pdf-file', [PDFController::class, 'index']);