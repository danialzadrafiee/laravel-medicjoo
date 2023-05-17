<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'descirbe',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
