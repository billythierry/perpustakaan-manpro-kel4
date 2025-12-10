<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with('book')
            ->where('user_id', Auth::id())
            ->orderBy('borrow_date', 'desc')
            ->get();

        return view('member.loan', compact('loans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,book_id',
        ]);

        $book = Book::findOrFail($request->book_id);

        if($book->stock <= 0)
        {
            return back()->with('error', 'Stok buku habis, tidak dapat dipinjam');
        }

        Loan::create([
            'user_id'      => Auth::id(),
            'book_id'      => $request->book_id,
            'borrow_date'  => now(),               
            'due_date'     => now()->addDays(7),  
            'return_date'  => null,
            'status'       => 'diajukan',
            'fine_amount'  => 0                    
        ]);

        return redirect()->route('member.loan.index')
                         ->with('success', 'Permintaan peminjaman berhasil diajukan!');
    }

    public function returnBook($id)
    {
        $loan = Loan::where('user_id', Auth::id())->findOrFail($id);

        $loan->return_date = now();

        if (now()->gt($loan->due_date)) {
            $loan->fine_amount = 20000;       
        }

        $loan->book->stock += 1;
        $loan->book->save();

        $loan->status = 'dikembalikan';
        $loan->save();

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan!');
    }
}
