<?php

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

$factory->define(App\Models\UserAddress::class, function (Faker $faker) {

    return [
        'description' =>  $faker->streetAddress,
        'zip_code' => $faker->numberBetween(10000000,99999999),
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'country' => 'Brasil',
    ];
});
