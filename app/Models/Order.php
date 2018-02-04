<?php
namespace App\Models;

use App\Models\Location;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    //protected $primaryKey = 'id';
    protected $guarded = ['id'];
    // protected $fillable = ['id', 'user_id', 'completed'];
    // protected $hidden = [];
    // protected $dates = [];
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function attendant()
    {
        return $this->belongsTo(User::class, 'attendant_id');
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopePending( $query )
    {
        return $query->where('completed', false);
    }
    public function scopeCompleted( $query )
    {
        return $query->where('completed', true);
    }
    public function scopeAvailable( $query )
    {
        return $query->where('attendant_id', null);
    }
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