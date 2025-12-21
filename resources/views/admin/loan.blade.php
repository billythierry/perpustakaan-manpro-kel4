@extends('admin.layouts.main')

@section('title', 'Kelola Peminjaman Buku')

@section('content')
<div class="container mt-4">

    <h1 class="mb-4">Kelola Peminjaman Buku</h1>

    {{-- ================= NOTIFIKASI ================= --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ================= CETAK PDF ================= --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">
            Cetak Laporan Peminjaman (PDF)
        </div>
        <div class="card-body">
            <form action="{{ route('admin.loan.report.pdf') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-4">
                    <label class="form-label">Pilih Tanggal Peminjaman</label>
                    <input type="date" name="borrow_date" class="form-control" required>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button class="btn btn-danger w-100">
                        Cetak PDF
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ================= TABEL ================= --}}
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light text-center">
            <tr>
                <th>Judul Buku</th>
                <th>Nama Peminjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tenggat Pengembalian</th>
                <th>Tanggal Pengembalian</th>
                <th>Status</th>
                <th>Denda</th>
                <th style="width: 200px">Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse($loans as $loan)
            <tr>
                {{-- JUDUL --}}
                <td>{{ $loan->book->title ?? '-' }}</td>

                {{-- USER --}}
                <td>{{ $loan->user->username ?? '-' }}</td>

                {{-- TANGGAL --}}
                <td>{{ \Carbon\Carbon::parse($loan->borrow_date)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($loan->due_date)->format('d-m-Y') }}</td>
                <td>
                    {{ $loan->return_date
                        ? \Carbon\Carbon::parse($loan->return_date)->format('d-m-Y')
                        : '-' }}
                </td>

                {{-- STATUS --}}
                <td class="text-center">
                    @php
                        $statusLabel = ucwords(str_replace('_', ' ', $loan->status));

                        $statusClass = match($loan->status) {
                            'diajukan'               => 'bg-warning',
                            'dipinjam'               => 'bg-primary',
                            'pengembalian_diajukan'  => 'bg-info',
                            'dikembalikan'           => 'bg-success',
                            'ditolak'                => 'bg-danger',
                            default                  => 'bg-secondary'
                        };
                    @endphp

                    <span class="badge {{ $statusClass }}">
                        {{ $statusLabel }}
                    </span>
                </td>

                {{-- DENDA --}}
                <td class="text-end">
                    Rp {{ number_format($loan->fine_amount, 0, ',', '.') }}
                </td>

                {{-- AKSI --}}
                <td class="text-center">

                    {{-- SETUJUI / TOLAK --}}
                    @if($loan->status === 'diajukan')
                        <div class="d-flex justify-content-center gap-1">
                            <form action="{{ route('admin.loan.approve', $loan->loan_id) }}" method="POST">
                                @csrf
                                <button class="btn btn-success btn-sm">
                                    Setujui
                                </button>
                            </form>

                            <form action="{{ route('admin.loan.reject', $loan->loan_id) }}" method="POST">
                                @csrf
                                <button class="btn btn-danger btn-sm">
                                    Tolak
                                </button>
                            </form>
                        </div>

                    {{-- TERIMA PENGEMBALIAN --}}
                    @elseif($loan->status === 'pengembalian_diajukan')
                        <form action="{{ route('admin.loan.return.accept', $loan->loan_id) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary btn-sm">
                                Terima Pengembalian
                            </button>
                        </form>

                    @else
                        <span class="text-muted">-</span>
                    @endif

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center text-muted">
                    Tidak ada data peminjaman
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{-- ================= PAGINATION ================= --}}
    @if(method_exists($loans, 'links'))
        <div class="mt-3">
            {{ $loans->links() }}
        </div>
    @endif

</div>
@endsection
