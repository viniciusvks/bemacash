<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new App\Models\User();
        $user->name = 'Usuário de Testes';
        $user->email = 'user@email.com';
        $user->document_number = 123456;
        $user->password = bcrypt('secret');

        $user->save();
    }
}
