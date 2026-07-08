<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookReturn extends Model
{
    use HasFactory;

    protected $table = 'returns';

    protected $fillable = [
        'borrowing_id',
        'return_date',
        'condition',
        'note',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    // Satu pengembalian berasal dari satu peminjaman
    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class);
    }
}