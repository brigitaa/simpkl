<?php

namespace Tests\Feature\iterasi5;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;

class GuruTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tambah_data_guru()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->post(route('guru.store'), [
                            'nip' => '22556600998855',
                            'nama_guru' => 'guru 4',
                            'no_telp_guru' => '081190067744',
                            'alamat' => 'Jl. Limaenam'
                           ]);
        $response->assertStatus(302);
    }

    public function test_lihat_manajemen_guru() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->get(route('guru.index'));
        $response->assertStatus(200);
    }

    public function test_ubah_data_guru()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->put(route('guru.update', '1'), [
                            'nip' => '12345555579',
                            'nama_guru' => 'guru 1',
                            'no_telp_guru' => '081509876543',
                            'alamat' => 'Jl. Tigaempat'
                           ]);
        $response->assertStatus(302);
    }

    public function test_hapus_data_guru() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->delete(route('guru.destroy',4));
        $response->assertStatus(302);
    }
}
