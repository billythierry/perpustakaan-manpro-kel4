<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman Buku</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        .date {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #333;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

    <h2>LAPORAN PEMINJAMAN BUKU</h2>
    <div class="date">Tanggal: {{ $date }}</div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Nama Peminjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tenggat</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $loan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $loan->book->title ?? '-' }}</td>
                <td>{{ $loan->user->username ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($loan->borrow_date)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($loan->due_date)->format('d-m-Y') }}</td>
                <td>{{ ucfirst(str_replace('_', ' ', $loan->status)) }}</td>
                <td>Rp {{ number_format($loan->fine_amount, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
