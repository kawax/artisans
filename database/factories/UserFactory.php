<?php

use App\Model\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'id'             => $faker->unique()->randomNumber,
        'name'           => $faker->unique()->userName,
        'avatar'         => $faker->imageUrl(240, 240),
        'title'          => $faker->sentence,
        'message'        => $faker->text,
        'remember_token' => Str::random(10),
    ];
});
