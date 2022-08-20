<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kepalasekolah;

class KepalasekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kepalasekolah::create([
            'nip' => '19630409 198903 1 011',
            'nama_kepsek' => 'Drs. Rusjanto, MM',
            'jabatan' => 'Kepala Sekolah',
            'pangkat_gol' => 'Pembina Tk. I'
        ]);
    }
}
