<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
// use Faker\Generator as Faker;



$factory->define(Order::class, function () {
$persianFaker = Faker\Factory::create('fa_IR');
    return [
       'user_id'=>$persianFaker->numberBetween(1,2),
        'name'=>$persianFaker->name,
        'brand'=>$persianFaker->lastName(10),
        'count'=>$persianFaker->numberBetween(1,20),
        'unit'=>'جعبه',
        'status'=>$persianFaker->numberBetween(0,2)
    ];
});
