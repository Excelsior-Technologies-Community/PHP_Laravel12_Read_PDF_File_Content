<!DOCTYPE html>
<html>

<head>
    <title>PDF List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #343a40;
            font-weight: 600;
        }

        .table {
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        thead {
            background: #0d6efd;
            color: #fff;
            font-weight: 500;
        }

        tbody tr:hover {
            background: #e9f2ff;
            transition: all 0.3s;
        }

        .btn-info {
            background: #17a2b8;
            border: none;
        }

        .btn-info:hover {
            background: #138496;
        }

        .btn-success {
            background: #28a745;
            border: none;
        }

        .btn-success:hover {
            background: #218838;
        }

        .container {
            max-width: 900px;
            margin-top: 50px;
        }

        @media (max-width: 576px) {
            .table {
                font-size: 14px;
            }

            h2 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>PDF List</h2>
        <table class="table table-striped table-bordered align-middle text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Downloads</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pdfs as $pdf)
                    <tr>
                        <td>{{ $pdf->id }}</td>
                        <td>{{ $pdf->name }}</td>
                        <td>{{ $pdf->download_count }}</td>
                        <td>
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