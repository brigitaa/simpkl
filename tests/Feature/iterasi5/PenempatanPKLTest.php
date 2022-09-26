<?php

namespace Tests\Feature\iterasi5;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;


class PenempatanPKLTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_lihat_seluruh_data_penempatan_pkl() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->get(route('penempatanPKL.index'));
        $response->assertStatus(200);
    }

    public function test_ubah_data_penempatan_pkl()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->put(route('penempatanPKL.update', '15'), [
                            'status_pkl_id'=>'3'
                           ]);
        $response->assertStatus(302);
    }

    public function test_lihat_data_penempatan_pkl() {
        $siswa = User::where('role_id', '5')->first();

        $response = $this->actingAs($siswa)->get(route('penempatanPKL.lihat'));
        $response->assertStatus(200);
    }
}
