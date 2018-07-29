<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FutureOrderItem extends Model
{
    // Table name
    protected $table = 'future_order_items';
    
    // Primary key
    public $primaryKey = 'id';

    // Don't allow timestamps
    public $timestamps = false;

    public function futureOrder() {
        return $this->belongsTo('App\Models\FutureOrder');
    }

    public function book() {
        return $this->belongsTo('App\Models\Book');
    }
}
