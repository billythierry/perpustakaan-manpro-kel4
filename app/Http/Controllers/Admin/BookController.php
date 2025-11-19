<?php

namespace App\Http\Controllers\Admin;
use App\Models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $book = Book::all();
        return view('admin.book', compact('book'));
    }

    // public function create()
    // {
    //     return view('admin.user.create');
    // }

    //Create User
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100', //mungkin bisa diganti 255 max
            'author' => 'required|string|max:100', //ini juga
            'publisher' => 'required|string|max:100', //ini juga
            'year' => 'required|integer|digits:4',
            'stock' => 'required|int'
        ]);

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'year' => $request->year,
            'stock' => $request->stock
        ]);

        return redirect()->route('admin.book.index')->with('success', 'Book created successfully');
    }

    //Update User
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:100', //mungkin bisa diganti 255 max, 
            'author' => 'required|string|max:100', //ini juga
            'publisher' => 'required|string|max:100', //ini juga
            'year' => 'required|integer|digits:4',
            'stock' => 'required|int'
        ]);

        $book->update($request->all());

        return redirect()->route('admin.book.index')->with('success', 'Book updated successfully');
    }

    //Delete User
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('admin.book.index')->with('success', 'Book deleted successfully');
    }
}
