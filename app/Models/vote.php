<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vote extends Model
{
    //
    protected $fillable = ['user_id', 'product_id', 'vote'];

    public function product()
    {
        return $this->belongsTo(product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
