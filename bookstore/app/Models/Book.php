<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // Table name
    protected $table = 'books';

    // Primary key
    public $primaryKey = 'id';

    // Don't allow timestamps
    public $timestamps = false;

    public function author() {
        return $this->belongsTo('App\Models\Author');
    }

    public function orderItem() {
        return $this->hasMany('App\Models\User');
    }

    public function techValleyTime() {
        return $this->$hasOne('App\Models\TechValleyTime');
    }

    public function review() {
        return $this->$hasMany('App\Models\Review');
    }
}
