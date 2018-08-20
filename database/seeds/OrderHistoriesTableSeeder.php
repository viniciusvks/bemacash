<?php

use Illuminate\Database\Seeder;

class OrderHistoriesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Order::all()->each(function (\App\Models\Order $order){

            $order->history()
                ->createMany(factory(\App\Models\OrderHistory::class, rand(1,5))->raw());

        });

    }
}