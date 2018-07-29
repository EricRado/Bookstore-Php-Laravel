<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    // Table name
    protected $table = 'credit_cards';
    
    // Primary key
    public $primaryKey = 'id';

    // Don't allow timestamps
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
