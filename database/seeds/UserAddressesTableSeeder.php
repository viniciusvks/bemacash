<?php

use Illuminate\Database\Seeder;

class UserAddressesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::all()->each(function (\App\Models\User $user){

            $user->addresses()
                ->createMany(factory(\App\Models\UserAddress::class, 2)->raw());

        });
    }
}