<?php

use Illuminate\Database\Seeder;

class KitsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Kit::class,10)->create()
            ->each(function (\App\Models\Kit $kit){

                $kit->license()
                    ->associate(\App\Models\License::all()->random());

                $products = \App\Models\Product::all();

                $products->random(rand(1,$products->count()))
                    ->each(function ($product) use(&$kit){

                        $kit->products()
                            ->attach($product, ['quantity' => rand(1,10)]);

                    });

                $kit->save();

            });
    }
}
