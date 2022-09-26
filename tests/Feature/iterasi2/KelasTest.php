<?php

namespace Tests\Feature\iterasi2;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;

class KelasTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tambah_kelas()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->post(route('kelas.store'), [
                            'kode_kelas'=>'TKJ3',
                            'nama_kelas'=>'XI TKJ 3',
                            'kompetensi_keahlian_id'=>'1'
                           ]);
        $response->assertStatus(302);
    }

    public function test_lihat_manajemen_kelas() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->get(route('kelas.index'));
        $response->assertStatus(200);
    }

    public function test_ubah_kelas()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->put(route('kelas.update', '5'), [
                            'kode_kelas'=>'TKJ4',
                            'nama_kelas'=>'XI TKJ 4',
                            'kompetensi_keahlian_id'=>'1'
                           ]);
        $response->assertStatus(302);
    }

    public function test_hapus_kelas() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->delete(route('kelas.destroy',5));
        $response->assertStatus(302);
    }
}
