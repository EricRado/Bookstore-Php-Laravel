<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FutureOrder extends Model
{
    // Table name
    protected $table = 'future_orders';
    
    // Primary key
    public $primaryKey = 'id';

    // Don't allow timestamps
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
