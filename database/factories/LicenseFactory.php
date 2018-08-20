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

$factory->define(App\Models\License::class, function (Faker $faker) {

    $licenses = collect([
        [
            'name' => 'BEMACASH VESTUÁRIO NFCe',
            'contract' => $faker->text
        ],
        [
            'name' => 'BEMACASH COMÉRCIO NFCe',
            'contract' => $faker->text
        ]
    ]);

    return $licenses->random();
});
