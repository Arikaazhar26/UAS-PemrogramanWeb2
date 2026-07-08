<?php 

namespace App\Exports;

use App\Models\Fine;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FinesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Fine::with(['member','book'])->get()->map(function ($fine) {
            return [
                'Member' => $fine->member->name ?? '-',
                'Book' => $fine->book->title ?? '-',
                'Days Late' => $fine->days_late,
                'Amount' => $fine->amount,
                'Status' => $fine->status,
                'Created At' => $fine->created_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Member',
            'Book',
            'Days Late',
            'Amount',
            'Status',
            'Created At'
        ];
    }
}