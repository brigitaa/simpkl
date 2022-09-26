<?php

namespace Tests\Feature\iterasi4;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;

class PengajuanTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_lihat_seluruh_data_pengajuan_pkl() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->get(route('pengajuanPKL.lihat'));
        $response->assertStatus(200);
    }

    public function test_lihat_detail_data_pengajuan_pkl() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->get(route('pengajuanPKL.showdetail','P-0000000000002'));
        $response->assertStatus(200);
    }

    public function test_konfirmasi_data_pengajuan_pkl_pokja() {
        $pokjapkl = User::where('role_id', '2')->first();

        $response = $this->actingAs($pokjapkl)
                         ->post(route('pengajuanPKL.terima_pengajuan_pokja','P-0000000000004'));
        $response->assertStatus(302);
    }

    public function test_konfirmasi_data_pengajuan_pkl_kaprog() {
        $kaprog = User::where('role_id', '3')->first();

        $response = $this->actingAs($kaprog)
                         ->post(route('pengajuanPKL.terima_pengajuan_kaprog','P-0000000000004'));
        $response->assertStatus(302);
    }

    public function test_cetak_surat_pengantar_pkl() {
        $tatausaha = User::where('role_id', '4')->first();

        $response = $this->actingAs($tatausaha)->get(route('pengajuanPKL.create_surat_pengantar','P-0000000000002'));
        $response->assertStatus(200);
    }
}
