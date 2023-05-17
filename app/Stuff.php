<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stuff extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'brands',
        'image',
        'tags',
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
