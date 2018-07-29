<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    // Table name
    protected $table = 'address';
    
    // Primary key
    public $primaryKey = 'id';

    // Don't allow timestamps
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'street_address', 'city', 'state', 'zip_code',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function order() {
        return $this->hasMany('App\Models\Order');
    }
}
