<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Walter White';
        $user->email = 'heisenberg@test.com';
        $user->password = Hash::make('pizzaROOF@22');
        $user->save();
    }
}
