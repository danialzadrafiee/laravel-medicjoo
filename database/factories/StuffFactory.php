<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Stuff;


$factory->define(Stuff::class, function () {
    $persianFaker = Faker\Factory::create('fa_IR');
    return [
       'category_id'=> $persianFaker->numberBetween(1,4),
       'name'=> $persianFaker->name,
       'brands'=> implode(',',[
           $persianFaker->name,
           $persianFaker->name,
           $persianFaker->name]),
       'image'=> "https://picsum.photos/id/".$persianFaker->numberBetween(0,100)."/200/200",
       'tags'=> implode(',',[
        $persianFaker->name,
        $persianFaker->name,
        $persianFaker->name]),

   ];
});
