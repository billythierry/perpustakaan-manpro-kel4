@extends('member.layouts.main')

@section('title', 'Peminjaman Buku')

@section('content')
<div class="container mt-4">

    <h1>Peminjaman Buku Saya</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tenggat Pengembalian</th>
                <th>Tanggal Pengembalian</th>
                <th>Status</th>
                <th>Denda</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $loan)
            <tr>
                <td>{{ $loan->book->title }}</td>
                <td>{{ $loan->borrow_date }}</td>
                <td>{{ $loan->due_date }}</td>
                <td>{{ $loan->return_date ?? '-' }}</td>

                <td>{{ ucfirst($loan->status) }}</td>

                <td>
                    @if(!$loan->return_date && now()->gt($loan->due_date))
                        <span class="text-danger">Rp20.000</span>
                    @else
                        {{ $loan->fine_amount }}
                    @endif
                </td>

                <td>
                    {{-- TAMPILKAN TOMBOL KEMBALIKAN HANYA JIKA STATUS = DIPINJAM --}}
                    @if($loan->status == 'dipinjam' && !$loan->return_date)
                        <form action="{{ route('member.loan.return', $loan->loan_id) }}" method="POST">
                            @csrf
                            <button class="btn btn-warning btn-sm">Kembalikan Buku</button>
                        </form>
                    @else
                        -
                    @endif
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
