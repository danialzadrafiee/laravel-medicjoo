<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'offer_id',
        'user_id',
        'vendor_id',
        'point',
        'describe',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
