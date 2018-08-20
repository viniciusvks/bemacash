<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::all()->each(function (\App\Models\User $user){

            $orders = factory(\App\Models\Order::class, 100)->make()
                        ->each(function (\App\Models\Order $order) use ($user){

                            $order->kit()
                                ->associate(\App\Models\Kit::all()->random());

                            $order->status()
                                ->associate(\App\Models\OrderStatus::all()->random());

                            $order->shippingAddress()
                                ->associate($user->addresses()
                                    ->get()
                                    ->random()
                                );

                        });

            $user->orders()
                ->saveMany($orders);

        });
    }
}