<?php

namespace Tests\Feature\iterasi1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;

class ThnAjaranTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tambah_tahun_ajaran()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->post(route('tahunajaran.store'), [
                                'kode_thn_ajaran' => '003',
                                'nama_thn_ajaran' => '2023/2024',
                           ]);
        $response->assertStatus(302);
    }

    public function test_lihat_manajemen_tahun_ajaran() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->get(route('tahunajaran.index'));
        $response->assertStatus(200);
    }

    public function test_ubah_tahun_ajaran()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->put(route('tahunajaran.update', '5'), [
                                'kode_thn_ajaran' => '004',
                                'nama_thn_ajaran' => '2024/2025',
                           ]);
        $response->assertStatus(302);
    }

    public function test_hapus_tahun_ajaran() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->delete(route('tahunajaran.destroy',5));
        $response->assertStatus(302);
    }

}
