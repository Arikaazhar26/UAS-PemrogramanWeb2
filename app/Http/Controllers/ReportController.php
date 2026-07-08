<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use PDF;

class ReportController extends Controller
{
    public function finesPdf()
    {
        $fines = Fine::with('borrowing')->get();

        $pdf = PDF::loadView('reports.fines', compact('fines'));

        return $pdf->download('laporan-denda.pdf');
    }
}