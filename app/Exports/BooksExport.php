<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BooksExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Book::select(
            'id',
            'title',
            'author',
            'publisher',
            'publish_year',
            'isbn',
            'stock'
        )->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Judul Buku',
            'Penulis',
            'Penerbit',
            'Tahun',
            'ISBN',
            'Stok',
        ];
    }
}