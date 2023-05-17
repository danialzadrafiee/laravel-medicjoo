<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Order extends Model
{
    protected $fillable = [
     
        'user_id', 'name', 'brand', 'count' , 'unit' , 'status' ,  'image' ,'order_describe',
    ];
    public function User()
    {
       return $this->hasOne(User::class,'id','user_id');
    }
    public function Offers(){
        return $this->hasMany(Offer::class);
    }
}

// status = 0 : ERSAL SHODE - WAITINGE TAIDDE
