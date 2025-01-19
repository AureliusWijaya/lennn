<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orderitem extends Model
{
    //
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    public function product()
    {
        return $this->belongsTo(product::class);
    }

    public function order()
    {
        return $this->belongsTo(order::class);
    }


    
}
