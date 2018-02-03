<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    //protected $primaryKey = 'id';
    // protected $guarded = ['id'];
    protected $fillable = [
        'name', 'email', 'password', 'provider', 'provider_id',
    ];
    // protected $hidden = [];
    // protected $dates = [];
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function servedOrders()
    {
        return $this->hasMany(Order::class, 'attendant_id');
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
