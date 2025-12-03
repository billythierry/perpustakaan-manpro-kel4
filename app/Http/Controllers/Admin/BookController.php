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

    //Create User
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255', //mungkin bisa diganti 255 max
            'author' => 'required|string|max:255', //ini juga
            'publisher' => 'required|string|max:255', //ini juga
            'year' => 'required|integer|digits:4',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $data = $request->only(['title', 'author', 'publisher', 'year', 'stock', 'image']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/books'), $filename);
            $data['image'] = 'uploads/books/' . $filename;
        }

        $book = Book::create($data);

        return response()->json(['success' => true, 'book' => $book]);
    }

    //Update User
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'author' => 'sometimes|string|max:255',
            'publisher' => 'sometimes|string|max:255',
            'year' => 'sometimes|integer|digits:4',
            'stock' => 'sometimes|integer',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $data = $request->only(['title', 'author', 'publisher', 'year', 'stock']);

        // Jika upload gambar baru
        if ($request->hasFile('image')) {

            // Hapus file lama jika ada
            if ($book->image && file_exists(public_path($book->image))) {
                unlink(public_path($book->image));
            }

            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/books'), $filename);
            $data['image'] = 'uploads/books/' . $filename;
        }

        $book->update($data);

        return response()->json(['success' => true]);
    }

    //Delete User
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('admin.book.index')->with('success', 'Book deleted successfully');
    }
}
