<!DOCTYPE html>
<html>
<head>
    <title>PDF Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .container { max-width: 900px; margin-top: 50px; }
        .table { background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        thead { background: #0d6efd; color: #fff; }
    </style>
</head>
<body>
    <div class="container">
        <h2>PDF Management System</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form action="{{ url('/pdfs/upload') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                    @csrf
                    <div class="col-md-5">
                        <input type="text" name="name" class="form-control" placeholder="PDF Name" required>
                    </div>
                    <div class="col-md-5">
                        <input type="file" name="file" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Upload</button>
                    </div>
                </form>
            </div>
        </div>

        <form action="{{ url('/pdfs') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by name..." value="{{ request('search') }}">
                <button class="btn btn-dark" type="submit">Search</button>
            </div>
        </form>

        <table class="table table-striped table-bordered text-center align-middle">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Downloads</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pdfs as $pdf)
                <tr>
                    <td>{{ $pdf->name }}</td>
                    <td><span class="badge bg-secondary">{{ $pdf->file_size }}</span></td>
                    <td>{{ $pdf->download_count }}</td>
                    <td>
                        <a href="{{ url('/pdf/read/' . $pdf->id) }}" class="btn btn-warning btn-sm">Read</a>
                        <a href="{{ url('/pdf/view/' . $pdf->id) }}" class="btn btn-info btn-sm" target="_blank">View</a>
                        <a href="{{ url('/pdf/download/' . $pdf->id) }}" class="btn btn-success btn-sm">Download</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>