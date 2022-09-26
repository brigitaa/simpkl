<?php

namespace Tests\Feature\iterasi5;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;

class StatusPKLTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tambah_data_status_pkl()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->post(route('statusPKL.store'), [
                            'nama_status_pkl'=>'Sedang berlangsung'
                           ]);
        $response->assertStatus(302);
    }

    public function test_lihat_manajemen_status_pkl() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->get(route('statusPKL.index'));
        // dd($response);
        $response->assertStatus(200);
    }

    public function test_ubah_data_status_pkl()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->put(route('statusPKL.update', '1'), [
                            'nama_status_pkl'=>'Belum Terlaksana'
                           ]);
        $response->assertStatus(302);
    }

    public function test_hapus_data_status_pkl() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->delete(route('statusPKL.destroy',5));
        $response->assertStatus(302);
    }
}
