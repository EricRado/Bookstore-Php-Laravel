<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // Table name
    protected $table = 'books';

    // Primary key
    public $primaryKey = 'id';

    // Don't allow timestamps
    public $timestamps = false;

}
