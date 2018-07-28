<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechValleyTime extends Model
{
    // Table name
    protected $table = 'tech_valley_time';

    // Primary key
    public $primaryKey = 'id';

    // Don't allow timestamps
    public $timestamps = false;

    public function book() {
        return $this->hasOne('App\Models\Book');
    }
}
