<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;
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

}
