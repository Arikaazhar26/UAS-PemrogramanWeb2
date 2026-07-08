<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\Author;


class Book extends Model
{
    use HasFactory;


    protected $fillable = [

        'title',
        'author',
        'publisher',
        'publish_year',
        'isbn',
        'stock',
        'category_id',
        'description',
        'cover',

    ];



    /*
    |--------------------------------------------------------------------------
    | Relasi Category
    |--------------------------------------------------------------------------
    */


    public function category()
    {

        return $this->belongsTo(Category::class);

    }





    /*
    |--------------------------------------------------------------------------
    | Relasi Many To Many Author
    |--------------------------------------------------------------------------
    */


    public function authors()
    {

        return $this->belongsToMany(Author::class);

    }


}