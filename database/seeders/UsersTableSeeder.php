<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'wp.medicom.info@gmail.com')->first();

             User::create([
                'name' => 'Ihor Khaletskyi',
                'email' => 'wp.medicom.info@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('qwer1234'),
             ]);
    }
}
