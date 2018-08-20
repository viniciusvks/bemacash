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

$factory->define(App\Models\Product::class, function (Faker $faker) {

    $products = collect([
        [
            'name' => 'Licenciamento Bemacash Vestuário'
        ],
        [
            'name' => 'TABLET SAMSUNG GALAXY TAB E 9.6 SM-T 560 199 100070'
        ],
        [
            'name' => 'SUPORTE METALICO TABLET BEMACASH 9.6 pol 499 100720'
        ],
        [
            'name' => 'GAVETA DE DINHEIRO GD-56 PRETA 128000 100'
        ],
        [
            'name' => 'Licensa de Software Fiscal Manager'
        ],
        [
            'name' => 'MP-4200 TH ETHERNET BE 10 1000830'
        ],
        [
            'name' => 'LEITOR CCD BT SCANNER BR-200BT T03 1000 10'
        ],
        [
            'name' => 'Licensa de Sofware Bemacash'
        ]
    ]);

    return $products->random();
});
