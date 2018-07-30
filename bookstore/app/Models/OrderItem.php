<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // Table name
    protected $table = 'order_items';

    // Primary key
    public $primaryKey = 'id';

    // Don't allow timestamps
    public $timestamps = false;

    public function order() {
        return $this->belongsTo('App\Models\Order');
    }

    public function book() {
        return $this->belongsTo('App\Models\Book');
    }
}
