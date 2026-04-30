<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pdf;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function index(Request $request)
    {
        $query = Pdf::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $pdfs = $query->latest()->get();
        return view('pdf.index', compact('pdfs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|mimes:pdf|max:10000',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('pdfs', 'public');
            
            $sizeInBytes = $file->getSize();
            $fileSize = number_format($sizeInBytes / 1048576, 2) . ' MB';

            Pdf::create([
                'name' => $request->name,
                'file_path' => $path,
                'file_size' => $fileSize, 
                'download_count' => 0
            ]);
        }

        return back()->with('success', 'PDF Uploaded Successfully!');
    }

    public function read($id)
    {
        $pdf = Pdf::findOrFail($id);
        $path = storage_path('app/public/' . $pdf->file_path);

        if (!file_exists($path)) {
            return back()->with('error', 'File not found on server!');
        }

        return view('pdf.read', compact('pdf'));
    }

    public function view($id)
    {
        $pdf = Pdf::findOrFail($id);
        $path = storage_path('app/public/' . $pdf->file_path);

        if (!file_exists($path)) {
            return back()->with('error', 'File not found on server!');
        }

        return response()->file($path);
    }

    public function download($id)
    {
        $pdf = Pdf::findOrFail($id);
        $path = storage_path('app/public/' . $pdf->file_path);

        if (!file_exists($path)) {
            return back()->with('error', 'File not found on server!');
        }

        $pdf->increment('download_count');
        return response()->download($path);
    }
}