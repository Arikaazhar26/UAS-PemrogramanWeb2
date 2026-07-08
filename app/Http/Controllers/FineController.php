<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FinesExport;
use Illuminate\Http\Request;

class FineController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $fines = Fine::with(['member', 'book'])
            ->when($search, function ($query) use ($search) {

                $query->whereHas('member', function ($q) use ($search) {

                    $q->where('name', 'like', "%{$search}%");

                })->orWhereHas('book', function ($q) use ($search) {

                    $q->where('title', 'like', "%{$search}%");

                });

            })
            ->latest()
            ->paginate(10);

        // Total seluruh denda
        $totalFines = Fine::sum('amount');

        return view('fines.index', compact(
            'fines',
            'totalFines',
            'search'
        ));
    }

    public function exportPdf()
    {
        $fines = Fine::with(['member','book'])->get();

        $pdf = Pdf::loadView('fines.pdf', compact('fines'));

        return $pdf->download('data-denda.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new FinesExport, 'data-denda.xlsx');
    }
}