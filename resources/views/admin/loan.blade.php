@extends('admin.layouts.main')

@section('title', 'Kelola Peminjaman')

@section('content')
<div class="container mt-4">

    <h1>Daftar Peminjaman Buku</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Judul Buku</th>
                <th>Nama Peminjam</th>
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
                <td>{{ $loan->user->username ?? $loan->user->name ?? 'Tanpa Nama' }}</td>

                <td>{{ $loan->borrow_date }}</td>
                <td>{{ $loan->due_date }}</td>
                <td>{{ $loan->return_date ?? '-' }}</td>

                <td>
                    <span class="badge 
                        @if($loan->status == 'diajukan') bg-warning 
                        @elseif($loan->status == 'dipinjam') bg-primary 
                        @elseif($loan->status == 'dikembalikan') bg-success 
                        @elseif($loan->status == 'ditolak') bg-danger 
                        @endif">
                        {{ ucfirst($loan->status) }}
                    </span>
                </td>

                <td>
                    @if(!$loan->return_date && now()->gt($loan->due_date))
                        <span class="text-danger">Rp {{ number_format(20000,0,',','.') }}</span>
                    @else
                        {{ number_format($loan->fine_amount,0,',','.') }}
                    @endif
                </td>

                <td>
                    @if($loan->status == 'diajukan')
                        <div class="d-flex gap-1">
                            {{-- SETUJUI --}}
                            <form action="{{ route('admin.loan.approve', $loan->loan_id) }}" method="POST">
                                @csrf
                                <button class="btn btn-success btn-sm">Setujui</button>
                            </form>

                            {{-- TOLAK --}}
                            <form action="{{ route('admin.loan.reject', $loan->loan_id) }}" method="POST">
                                @csrf
                                <button class="btn btn-danger btn-sm">Tolak</button>
                            </form>
                        </div>
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
