<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //
    protected $fillable = ['name', 'price', 'description', 'image', 'category_id'];

    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function order()
    {
        return $this->belongsToMany(order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
