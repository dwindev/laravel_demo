<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => str_random(10),
        'text' => str_random(20)
    ];
});
