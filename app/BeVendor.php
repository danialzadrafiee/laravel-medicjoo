<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BeVendor extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'lastname',
        'phone',
        'password',
        'describe',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
