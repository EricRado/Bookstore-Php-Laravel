<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','first_name', 'last_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Don't allow timestamps
    public $timestamps = false;

    public function address() {
        return $this->hasMany('App\Models\Address');
    }

    public function creditCard() {
        return $this->hasMany('App\Models\CreditCard');
    }

    public function order() {
        return $this->hasMany('App\Models\Order');
    }

    public function futureOrder() {
        return $this->hasOne('App\Models\FutureOrder');
    }

   public function review() {
        return $this->hasMany('\App\Models\Review');
   }
}
