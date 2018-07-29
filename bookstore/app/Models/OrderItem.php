<?php

namespace App;

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
        return $this->belongsTo('App\Models\Orders');
    }
}
