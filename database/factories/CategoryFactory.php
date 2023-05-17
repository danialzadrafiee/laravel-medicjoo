<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {

    return [
            'name' =>$faker->name,
            'parent_id' => random_int(0,1),
    ];
});
