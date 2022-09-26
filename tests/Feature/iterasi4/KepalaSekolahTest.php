<?php

namespace Tests\Feature\iterasi4;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;

class KepalaSekolahTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_lihat_data_kepala_sekolah() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->get(route('kepalasekolah.index'));
        $response->assertStatus(200);
    }

    public function test_ubah_data_kepala_sekolah()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->put(route('kepalasekolah.update', '1'), [
                            'nip' => '19630409 123456 1 022',
                            'nama_kepsek' => 'Drs. Rusjanto',
                            'jabatan' => 'Kepala Sekolah',
                            'pangkat_gol' => 'Pembina Tingkat I'
                           ]);
        $response->assertStatus(302);
    }
}
