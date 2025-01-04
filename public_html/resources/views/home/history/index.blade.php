<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>History Transaksi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        /* Styling for container */
        .container {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        /* Styling for page title */
        h1 {
            font-family: 'Raleway', sans-serif;
            font-weight: 700;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Styling for table */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .table th, .table td {
            padding: 15px 20px;
            text-align: left;
            vertical-align: middle;
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
        }

        .table th {
            background-color: #6f42c1;
            color: white;
            font-weight: 600;
        }

        .table td {
            background-color: #f9f9f9;
            color: #333;
        }

        /* Hover effect for table rows */
        .table tr:hover {
            background-color: #f1f1f1;
            transition: background-color 0.3s ease;
        }

        /* Styling for links */
        .table a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
        }

        .table a:hover {
            text-decoration: underline;
            color: #0056b3;
        }

        /* Styling for empty table data */
        .table tbody tr td {
            text-align: center;
            font-style: italic;
        }

        /* Styling for buttons */
        .btn-view {
            background-color: #28a745;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            text-align: center;
        }

        .btn-view:hover {
            background-color: #218838;
            text-decoration: none;
        }

        /* Styling for back button */
        .btn-back {
            background-color: #6f42c1;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 600;
            display: block;
            width: 200px;
            margin: 30px auto;
            text-align: center;
        }

        .btn-back:hover {
            background-color: #0056b3;
            text-decoration: none;
        }

        /* Styling for table responsiveness */
        @media (max-width: 768px) {
            .table {
                font-size: 14px;
            }

            h1 {
                font-size: 24px;
            }

            .table th, .table td {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Riwayat Pesanan</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>No INV</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Pengiriman</th>
                    <th>Tanggal Transaksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->inv }}</td>
                    <td>{{ $order->harga }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>{{ ucfirst($order->pengiriman) }}</td>
                    <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Back Button -->
        <a style="text-decoration: none;" href="{{ route('index') }}" class="btn-back">Kembali ke Halaman Utama</a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>
