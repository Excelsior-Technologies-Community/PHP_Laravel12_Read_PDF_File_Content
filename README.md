# PHP_Laravel12_Read_PDF_File_Content

A complete guide to read text content from PDF files in Laravel 12 using the `spatie/pdf-to-text` package and the system `pdftotext` utility (part of Poppler).

---

## Introduction

This project shows how to extract plain text from PDF files in a Laravel 12 application. The implementation uses the popular `spatie/pdf-to-text` package which acts as a PHP wrapper for the `pdftotext` binary (provided by Poppler). The idea: upload or place a PDF in `public/` and call Spatie's `Pdf::getText()` to fetch the PDF contents.

---

## Requirements

- PHP 8+
- Composer
- Laravel 12
- System utility `pdftotext` (Poppler)
- A web server (artisan serve, XAMPP, Valet, etc.)

> Note: Spatie's package requires the `pdftotext` system binary to be installed and accessible in your PATH.

---

## Project Folder Structure (relevant files)

```
PHP_Laravel12_Read_PDF_File_Content/
├── app/
│   └── Http/
│       └── Controllers/
│           └── PDFController.php
├── public/
│   └── sample-demo.pdf
├── routes/
│   └── web.php
├── composer.json
└── README.md
```

---

## Step-by-step Setup

### 1. Create Laravel project

```bash
composer create-project laravel/laravel PHP_Laravel12_Read_PDF_File_Content
cd PHP_Laravel12_Read_PDF_File_Content
```


### 2. Install Spatie package

```bash
composer require spatie/pdf-to-text
```

This package provides a simple `Pdf::getText($path)` interface.


### 3. Install system dependency (pdftotext / Poppler)

**Ubuntu / Debian**

```bash
sudo apt-get install poppler-utils
```

**macOS (Homebrew)**

```bash
brew install poppler
```

**RedHat / CentOS / Fedora**

```bash
yum install poppler-utils
```

**Windows**

Download Poppler for Windows from:

https://github.com/oschwartz10612/poppler-windows/releases/

Choose:

Release-25.12.0-0.zip


Extract the ZIP to a folder, e.g.:

C:\poppler-25.12.0


Add to your system PATH:

C:\poppler-25.12.0\Library\bin


Verify installation:

Open a new Command Prompt and run:

pdftotext -v


If you see version info, Poppler is installed correctly.### 4. Place a sample PDF

Put a sample PDF (e.g. `sample-demo.pdf`) into the `public/` folder.


### 5. Create Controller

`app/Http/Controllers/PDFController.php`

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\PdfToText\Pdf;

class PDFController extends Controller
{
    /**
     * Display the text content of a PDF file.
     *
     * This function reads a PDF stored in the public folder,
     * extracts its plain text using Spatie's PdfToText package,
     * and returns it to the browser.
     */
    public function index()
    {
        // Step 1: Define the full path to the PDF file.
        // The public_path() function gives the absolute path to the 'public/' folder.
        $pdfPath = public_path('sample-demo.pdf');

        // Step 2: Define the path to the pdftotext binary (Poppler utility).
        // Make sure this path matches where Poppler is installed on your Windows machine.
        $binary = 'C:\poppler-25.12.0\Library\bin\pdftotext.exe';

        // Step 3: Create a new Pdf instance using the binary path
        // and extract text from the PDF file.
        // - setPdf($pdfPath) points to the PDF file to read.
        // - text() executes the extraction and returns the text content.
        $text = (new Pdf($binary))
                    ->setPdf($pdfPath)
                    ->text();

        // Step 4: Return the extracted text to the browser.
        // nl2br() converts newlines (\n) to HTML <br> tags for proper display in browser.
        return nl2br($text);
    }
}
```


### 6. Add Route

`routes/web.php`

```php
use App\Http\Controllers\PDFController;

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
```

### 7. Run the application

```bash
php artisan serve
```

Visit:

```
http://localhost:8000/read-pdf-file
```

Output:

```
26/06/2023, 18:32

Discover Keyword Ideas

This is demo file
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
deserunt mollit anim id est laborum.

localhost:8000/discover-keywords

1/1

```
PDF File:

You can download the sample PDF using the link below:
```
[Download sample-demo.pdf](public/sample-demo.pdf)
```
This PDF contains sample text that can be used for testing:

---

## Notes & Tips

- If you get an error like "pdftotext not found" or empty output, ensure the Poppler `pdftotext` binary is installed and available in your PATH.
- For production servers, install Poppler using your server package manager or use Docker image that contains Poppler.
- The extracted text may not preserve PDF layout; it returns plain text. For structured extraction (forms, table layout), consider advanced PDF parsers.

---

## License

MIT — use freely for learning and assignment purposes.

Now Your Project is Ready! 
