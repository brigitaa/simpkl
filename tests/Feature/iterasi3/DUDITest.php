<?php

namespace Tests\Feature\iterasi3;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;

class DUDITest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tambah_data_dudi()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->post(route('dudi.store'), [
                            'nama_dudi'=>'PT Makmur',
                            'alamat_dudi'=>'KM 15'
                           ]);
        $response->assertStatus(302);
    }

    public function test_lihat_manajemen_dudi() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->get(route('dudi.index'));
        $response->assertStatus(200);
    }

    public function test_ubah_data_dudi()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->put(route('dudi.update', '2'), [
                            'nama_dudi'=>'PT Makmur Jaya Abadi',
                            'alamat_dudi'=>'Jl. Satuduatiga'
                           ]);
        $response->assertStatus(302);
    }

    public function test_hapus_data_dudi() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->delete(route('dudi.destroy',2));
        $response->assertStatus(302);
    }
}
