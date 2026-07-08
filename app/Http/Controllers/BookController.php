<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\BooksExport;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{
    // 🔥 LIST + SEARCH
    public function index(Request $request)
    {
        $search = $request->search;

        $books = Book::with('category')
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                      ->orWhere('author', 'like', "%$search%")
                      ->orWhere('publisher', 'like', "%$search%")
                      ->orWhere('isbn', 'like', "%$search%");
            })
            ->latest()
            ->paginate(10);

        return view('books.index', compact('books', 'search'));
    }

    // 🔥 FORM CREATE
    public function create()
    {
        return view('books.create', [
            'categories' => Category::all()
        ]);
    }

    // 🔥 STORE (UPLOAD GAMBAR FIX)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'publish_year' => 'required',
            'isbn' => 'required|unique:books,isbn',
            'stock' => 'required|integer',
            'category_id' => 'required',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $filename = null;

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('covers'), $filename);
        }

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'publish_year' => $request->publish_year,
            'isbn' => $request->isbn,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'cover' => $filename,
        ]);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    // 🔥 EDIT
    public function edit($id)
    {
        return view('books.edit', [
            'book' => Book::findOrFail($id),
            'categories' => Category::all()
        ]);
    }

    // 🔥 UPDATE
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'publish_year' => 'required',
            'isbn' => 'required',
            'stock' => 'required|integer',
            'category_id' => 'required',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $filename = $book->cover;

        if ($request->hasFile('cover')) {

            if ($book->cover && file_exists(public_path('covers/'.$book->cover))) {
                unlink(public_path('covers/'.$book->cover));
            }

            $file = $request->file('cover');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('covers'), $filename);
        }

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'publish_year' => $request->publish_year,
            'isbn' => $request->isbn,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'cover' => $filename,
        ]);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil diperbarui');
    }

    public function show($id)
{
    $book = Book::with('category')->findOrFail($id);

    return view('books.show', compact('book'));
}

public function exportPdf()
{
    $books = Book::with('category')->get();

    $pdf = Pdf::loadView('books.pdf', compact('books'));

    return $pdf->download('data_buku.pdf');
}

public function exportExcel()
{
    return Excel::download(
        new BooksExport,
        'data_buku.xlsx'
    );
}

    // 🔥 DELETE
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if ($book->cover && file_exists(public_path('covers/'.$book->cover))) {
            unlink(public_path('covers/'.$book->cover));
        }

        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dihapus');
    }
}