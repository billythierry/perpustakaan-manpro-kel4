<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Get current user ID
        $userId = Auth::id();
        
        // Hitung total buku yang tersedia di perpustakaan
        $totalBooks = Book::count();
        
        // Hitung peminjaman aktif user ini (status = 'dipinjam')
        $activeBorrows = Loan::where('user_id', $userId)
                            ->where('status', 'dipinjam')
                            ->count();
        
        // Hitung total riwayat peminjaman user ini (semua status)
        $totalHistory = Loan::where('user_id', $userId)->count();
        
        // Ambil 5 peminjaman terakhir user ini
        $recentBorrows = Loan::where('user_id', $userId)
                            ->with('book')
                            ->orderBy('borrow_date', 'desc')
                            ->limit(5)
                            ->get();
        
        return view('member.dashboard', compact(
            'totalBooks',
            'activeBorrows',
            'totalHistory',
            'recentBorrows'
        ));
    }
}