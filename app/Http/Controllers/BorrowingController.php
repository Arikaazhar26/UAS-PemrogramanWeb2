<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Book;
use App\Models\Member;
use App\Models\Fine;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class BorrowingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $borrowings = Borrowing::with(['member', 'book'])

            ->when($search, function ($query) use ($search) {

                $query->whereHas('member', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })

                ->orWhereHas('book', function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%");
                })

                ->orWhere('status', 'like', "%{$search}%");
            })

            ->latest()
            ->paginate(10);

           foreach ($borrowings as $b) {

    if (
        $b->status == 'borrowed' &&
        now()->gt($b->return_date)
    ) {

        $b->update([
            'status' => 'late'
        ]);

    }

}

        return view('borrowings.index', compact('borrowings', 'search'));
    }

    

    public function create()
    {
        return view('borrowings.create', [
            'books' => Book::where('stock', '>', 0)->get(),
            'members' => Member::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required',
            'book_id' => 'required',
            'borrow_date' => 'required|date',
            'return_date' => 'nullable|date',
        ]);

        $book = Book::findOrFail($request->book_id);

        $book->decrement('stock');

        Borrowing::create([
            'member_id' => $request->member_id,
            'book_id' => $request->book_id,
            'borrow_date' => $request->borrow_date,
            'return_date' => $request->return_date,
            'status' => 'borrowed'
        ]);

        return redirect()->route('borrowings.index')
            ->with('success', 'Buku berhasil dipinjam');
    }

   public function returnBook(Borrowing $borrowing)
{
    $today = Carbon::now();
    $dueDate = Carbon::parse($borrowing->return_date);

    $daysLate = 0;
    $fineAmount = 0;

    if ($today->greaterThan($dueDate)) {
        $daysLate = $today->diffInDays($dueDate);
        $fineAmount = $daysLate * 1000;
    }

    $borrowing->update([
        'actual_return_date' => $today,
        'status' => 'returned'
    ]);

    $borrowing->book->increment('stock');

    if ($daysLate > 0) {

        Fine::create([
            'borrowing_id' => $borrowing->id,
            'member_id'    => $borrowing->member_id,
            'book_id'      => $borrowing->book_id,
            'days_late'    => $daysLate,
            'amount'       => $fineAmount,
            'status'       => 'unpaid',
        ]);

    }

    return redirect()->route('borrowings.index')
        ->with('success','Buku berhasil dikembalikan.');
}
    public function exportPdf()
{
    $borrowings = Borrowing::with(['member', 'book'])
                    ->latest()
                    ->get();

    $pdf = Pdf::loadView(
        'borrowings.pdf',
        compact('borrowings')
    );

    return $pdf->download('laporan-peminjaman.pdf');
}
}