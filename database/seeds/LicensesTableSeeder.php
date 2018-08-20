<?php

use Illuminate\Database\Seeder;

class LicensesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\License::class, 10)->create();
    }
}
