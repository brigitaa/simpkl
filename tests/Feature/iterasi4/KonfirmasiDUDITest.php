<?php

namespace Tests\Feature\iterasi4;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;

class KonfirmasiDUDITest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_lihat_data_konfirmasi_dudi() {
        $siswa = User::where('role_id', '5')->first();

        $response = $this->actingAs($siswa)->get(route('konfirmasidudi.index'));
        $response->assertStatus(200);
    }

    public function test_tambah_konfirmasi_dudi()
    {
        $siswa = User::where('role_id', '5')->first();

        Storage::fake('local');
        $file = UploadedFile::fake()->create('file.pdf');

        $response = $this->actingAs($siswa)
                         ->post(route('konfirmasidudi.store'), [
                            'pengajuan_id'=>'P-0000000000002',
                            'balasan_dudi'=>$file,
                            'status_balasan_dudi'=>'Disetujui',
                           ]);
        // dd($response);
        $response->assertStatus(302);
    }

    public function test_lihat_seluruh_data_konfirmasi_dudi() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->get(route('konfirmasidudi.lihat'));
        $response->assertStatus(200);
    }

    public function test_ubah_konfirmasi_dudi()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->put(route('konfirmasidudi.update', 6), [
                            'pengajuan_id'=>'P-0000000000005',
                            'status_balasan_dudi'=>'Ditolak'
                           ]);
        $response->assertStatus(302);
    }
}
