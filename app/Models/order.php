<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    //

    protected $fillable = ['user_id', 'total_price', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderitem()
    {
        return $this->hasMany(orderitem::class);
    }

    public function product()
    {
        return $this->belongsToMany(product::class);
    }

    
}
