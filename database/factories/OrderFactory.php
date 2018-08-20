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

$factory->define(App\Models\Order::class, function (Faker $faker) {
    return [
        'status_updated_at' => $faker->dateTimeThisMonth,
        'comment' => $faker->optional()->text,
        'invoice_number' => $faker->numberBetween(100000000,999999999),
        'invoice_issue_date' => $faker->dateTimeThisMonth,
        'sales_executive' => $faker->optional()->name,
        'hardware_order_number' => $faker->optional()->numberBetween(1,999999999)
    ];
});
