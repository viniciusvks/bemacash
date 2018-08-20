<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(OrderStatusesTableSeeder::class);
         $this->call(LicensesTableSeeder::class);
         $this->call(ProductsTableSeeder::class);
         $this->call(UserAddressesTableSeeder::class);
         $this->call(KitsTableSeeder::class);
         $this->call(OrdersTableSeeder::class);
         $this->call(OrderHistoriesTableSeeder::class);
    }
}
