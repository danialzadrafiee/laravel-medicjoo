<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BannerSelected extends Model
{
    protected $table = 'banner_selected';
    protected $fillable = [
        'user_id',
        'location_1',
        'location_2',
        'title',
        'description',
        'image',
        'link',
    ];
}
