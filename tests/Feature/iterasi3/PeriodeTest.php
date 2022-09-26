<?php

namespace Tests\Feature\iterasi3;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;

class PeriodeTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tambah_data_periode_pkl()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->post(route('periode.store'), [
                            'tanggal_mulai'=>'10-01-2023',
                            'tanggal_selesai'=>'10-04-2023'
                           ]);
        $response->assertStatus(302);
    }

    public function test_lihat_manajemen_periode_pkl() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->get(route('periode.index'));
        $response->assertStatus(200);
    }

    public function test_ubah_data_periode_pkl()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->put(route('periode.update', '2'), [
                            'tanggal_mulai'=>'24-05-2023',
                            'tanggal_selesai'=>'24-08-2023'
                           ]);
        $response->assertStatus(302);
    }

    public function test_hapus_data_periode_pkl() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->delete(route('periode.destroy',2));
        $response->assertStatus(302);
    }
}
