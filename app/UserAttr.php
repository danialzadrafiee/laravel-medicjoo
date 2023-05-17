<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAttr extends Model
{
    protected $table = 'user_attrs';
    protected $fillable = [
        'user_id','job', 'address','active','approved'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
