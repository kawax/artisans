<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Tag::class, function (Faker $faker) {
    return [
        'tag' => $faker->unique()->words(2, true),
    ];
});
