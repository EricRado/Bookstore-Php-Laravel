<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Table name      
    protected $table = 'Order';

    // Primary key
    public $primaryKey = 'id';

    // Don't allow timestamps
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function address() {
        return $this->belongsTo('App\Models\Address');
    }

    public function orderItem() {
        return $this->hasMany('App\Models\OrderItem');
    }
}
