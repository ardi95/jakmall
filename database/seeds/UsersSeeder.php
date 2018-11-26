<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ardiansyah Pratama',
            'email' => 'customer@jakmall.com',
            'password' => bcrypt('rahasia')
        ]);
    }
}
