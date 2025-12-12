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
