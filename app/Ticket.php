<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id',
        'parent_id',
        'message',
        'amount',
        'status',
        'accepted',
        'tag',
    ];

}
