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
        return $this->belongsTo('App\Models\Book');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
