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

$factory->define(App\Models\OrderStatus::class, function (Faker $faker) {

    $statuses = collect([
        [
            'description' => 'RECEBIDO'
        ],
        [
            'description' => 'APROVADO'
        ],
        [
            'description' => 'REJEITADO'
        ],
        [
            'description' => 'FATURADO'
        ],
        [
            'description' => 'EM PREPARAÇÃO'
        ],
        [
            'description' => 'A CAMINHO'
        ],
        [
            'description' => 'ENTREGUE'
        ]
    ]);

    return $statuses->random();
});
