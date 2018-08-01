<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // Table name
    protected $table = 'reviews';

    // Primary key
    public $primaryKey = 'id';

    // Don't allow timestamps
    public $timestamps = false;

    public function book() {
        $this->belongsTo('App\Models\Book');
    }
}
