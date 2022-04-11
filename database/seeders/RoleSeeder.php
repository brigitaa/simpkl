<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  
        Role::create([
            'nama_role' => 'Admin'
        ]);

        Role::create([
            'nama_role' => 'Ketua Pokja PKL'
        ]);

        Role::create([
            'nama_role' => 'Kaprog'
        ]);

        Role::create([
            'nama_role' => 'Tata Usaha'
        ]);

        Role::create([
            'nama_role' => 'Siswa'
        ]);
    }
}
