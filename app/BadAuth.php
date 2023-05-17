<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BadAuth extends Model
{
    protected $table = 'bad_auth';
    protected $fillable = ['user_id','name','lastname','phone','password','active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
