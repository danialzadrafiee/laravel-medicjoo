<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddresses extends Model
{
    protected $fillable = [
        'user_id','title', 'address', 'location',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
