<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pdf;

class PdfController extends Controller
{
    public function index()
    {
        $pdfs = Pdf::all();
        return view('pdf.index', compact('pdfs'));
    }

    public function view($id)
    {
        $pdf = Pdf::findOrFail($id);
        $path = storage_path('app/public/' . $pdf->file_path);
        return response()->file($path);
    }

    public function download($id)
    {
        $pdf = Pdf::findOrFail($id);
        $pdf->increment('download_count');
        $path = storage_path('app/public/' . $pdf->file_path);
        return response()->download($path);
    }
}