<!DOCTYPE html>
<html>
<head>
    <title>Read PDF</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background: #f8f9fa; }
        .pdf-container {
            height: 80vh; 
            width: 100%;
            border-radius: 10px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid px-4 mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Viewing PDF: {{ $pdf->name }}</h3>
            <a href="{{ url('/pdfs') }}" class="btn btn-secondary">Back to List</a>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <iframe src="{{ url('/pdf/view/' . $pdf->id) }}" class="pdf-container"></iframe>
            </div>
        </div>
    </div>
</body>
</html>