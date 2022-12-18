<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        User::create([
            'name'=>'Admin',
            'username'=>'admin',
            'email'=>'admin@gmail.com',
            'password' => Hash::make('admin'),
            'remember_token' => \Str::random(50),
            'role_id'=>'1',
        ]);

        User::create([
            'name'=>'Ketua Pokja PKL',
            'username'=>'pokja',
            'email'=>'pokja@gmail.com',
            'password' => Hash::make('pokja'),
            'remember_token' => \Str::random(50),
            'role_id'=>'2',
        ]);

        User::create([
            'name'=>'Tata Usaha',
            'username'=>'tatausaha',
            'email'=>'tatausaha@gmail.com',
            'password' => Hash::make('tatausaha'),
            'remember_token' => \Str::random(50),
            'role_id'=>'4',
        ]);
    }
}
