<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Loan;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total buku
        $totalBooks = Book::count();
        
        // Hitung total user (tidak termasuk admin)
        $totalUsers = User::where('role', 'anggota')->count();
        
        // Hitung peminjaman aktif (status = 'dipinjam')
        $activeBorrowings = Loan::where('status', 'dipinjam')->count();
        
        // Hitung buku tersedia (stock > 0)
        $availableBooks = Book::sum('stock');
        
        return view('admin.dashboard', compact(
            'totalBooks',
            'totalUsers', 
            'activeBorrowings',
            'availableBooks'
        ));
    }
}