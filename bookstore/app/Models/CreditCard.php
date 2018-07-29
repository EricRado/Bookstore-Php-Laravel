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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_on_card', 'cc_number', 'security_code', 'expiration_date', 'provider',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
