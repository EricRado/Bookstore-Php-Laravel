<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    // Table name
    protected $table = 'addresses';
    
    // Primary key
    public $primaryKey = 'id';

    // Don't allow timestamps
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
