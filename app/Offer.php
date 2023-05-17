<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'vendor_id',
        'client_id',
        'order_id',
        'name',
        'order_brand',
        'offer_brand',
        'count',
        'image',
        'unit',
        'price',
        'expire',
    ];
    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function comment(){
        return $this->hasOne(Comment::class);
    }
}
