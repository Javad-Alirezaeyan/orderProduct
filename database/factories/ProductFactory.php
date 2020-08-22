<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {

    return [
        'brand_id' => \App\Brand::all()->random()->id,
        'name' => $faker->text(20),
        'price'=> $faker->numberBetween(1, 100)
    ];
});
