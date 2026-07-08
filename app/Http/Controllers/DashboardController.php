<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Borrowing;
use App\Models\Fine;

class DashboardController extends Controller
{
    public function index()
    {

        $totalBooks = Book::count();

        $totalMembers = Member::count();

        $borrowedBooks = Borrowing::where('status','Dipinjam')->count();

        $returnedBooks = Borrowing::where('status','Dikembalikan')->count();


        $totalFine = Fine::sum('amount');


        $latestBooks = Book::latest()->take(5)->get();


        $latestBorrowings = Borrowing::latest()
            ->take(5)
            ->get();


        // data grafik
        $chartData = [
            $totalBooks,
            $totalMembers,
            $borrowedBooks,
            $returnedBooks
        ];


        return view('dashboard', compact(
            'totalBooks',
            'totalMembers',
            'borrowedBooks',
            'returnedBooks',
            'totalFine',
            'latestBooks',
            'latestBorrowings',
            'chartData'
        ));
    }
}