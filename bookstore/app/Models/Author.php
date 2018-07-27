<?php

namespace App\Models\Author;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    // Table name
    protected $table = 'authors';
    
    // Primary key
    public $primaryKey = 'id';

    // Don't allow timestamps
    public $timestamps = false;

    public function books() {
        return $this->hasMany('App\Models\Book');
    }
}
