<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
    <link rel="stylesheet" href="/css/app.css"> <!-- Pastikan jalur CSS benar -->
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/transaction-history">Riwayat Transaksi</a></li>
                <!-- Tambahkan menu lainnya di sini -->
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h1>Riwayat Transaksi</h1>

            <table border="1" cellspacing="0" cellpadding="10">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Status</th>
                        <th>Total Pembayaran</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ ucfirst($transaction->status) }}</td>
                            <td>{{ number_format($transaction->total_amount, 2, ',', '.') }}</td>
                            <td>{{ $transaction->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Tidak ada riwayat transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} E-Commerce Anda</p>
    </footer>
</body>
</html>
