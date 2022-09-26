<?php

namespace Tests\Feature\iterasi2;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;

class KeahlianTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tambah_kompetensi_keahlian()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->post(route('kompetensikeahlian.store'), [
                            'kode_keahlian'=>'OTKP',
                            'nama_keahlian'=>'Perkantoran'
                           ]);
        $response->assertStatus(302);
    }

    public function test_lihat_manajemen_kompetensi_keahlian() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->get(route('kompetensikeahlian.index'));
        $response->assertStatus(200);
    }

    public function test_ubah_kompetensi_keahlian()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->put(route('kompetensikeahlian.update', '4'), [
                            'kode_keahlian'=>'OTKP',
                            'nama_keahlian'=>'Administrasi Perkantoran'
                           ]);
        $response->assertStatus(302);
    }

    public function test_hapus_kompetensi_keahlian() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->delete(route('kompetensikeahlian.destroy',4));
        $response->assertStatus(302);
    }
}
