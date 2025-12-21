<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['user', 'book'])
                    ->orderBy('borrow_date', 'desc')
                    ->paginate(10);

        return view('admin.loan', compact('loans'));
    }

    public function edit($id)
    {
        $loan = Loan::with(['user', 'book'])
                    ->where('loan_id', $id)
                    ->firstOrFail();

        return view('loan.index', compact('loan'));
    }

    public function approve($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->status = 'dipinjam';
        $loan->save();

        $loan->book->stock -= 1;
        $loan->book->save();

        return back()->with('success', 'Peminjaman disetujui.');
    }

    public function reject($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->status = 'ditolak';
        $loan->save();

        return back()->with('success', 'Peminjaman ditolak.');
    }

    public function acceptReturn($id)
    {
        $loan = Loan::with('book')->findOrFail($id);

        if ($loan->status !== 'pengembalian_diajukan') {
            return back()->with('error', 'Status tidak valid');
        }

        // Tambah stok buku
        $loan->book->stock += 1;
        $loan->book->save();

        $loan->status = 'dikembalikan';
        $loan->save();

        return back()->with('success', 'Pengembalian buku berhasil diverifikasi.');
    }

    public function exportPdf(Request $request)
    {
        $request->validate([
            'borrow_date' => 'required|date',
        ]);

        $date = Carbon::parse($request->borrow_date)->format('Y-m-d');

        $loans = Loan::with(['user', 'book'])
            ->whereDate('borrow_date', $date)
            ->orderBy('borrow_date', 'asc')
            ->get();

        if ($loans->isEmpty()) {
            return back()->with('error', 'Tidak ada data peminjaman pada tanggal tersebut');
        }

        $pdf = Pdf::loadView('admin.loan-report-pdf', [
            'loans' => $loans,
            'date'  => Carbon::parse($date)->translatedFormat('d F Y')
        ])->setPaper('A4', 'landscape');

        return $pdf->download('laporan-peminjaman-' . $date . '.pdf');
    }

}
