<?php

use Faker\Generator as Faker;

$factory->define(App\Tree::class, function (Faker $faker) {
    

    return [
        'name' => $faker->firstname,
        'location' => $faker->address,
        'ison' => $faker->boolean,
        'decorations' => rand(0,40)+10,
    ];
});