<?php

namespace App\Http\Controllers\Member;

use App\Models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookMemberController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $books = Book::when($search, function($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                           ->orWhere('author', 'like', "%{$search}%")
                           ->orWhere('publisher', 'like', "%{$search}%");
            })
            ->orderBy('title', 'asc')
            ->get();
        
        return view('member.book', compact('books'));
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return response()->json($book);
    }

    

}