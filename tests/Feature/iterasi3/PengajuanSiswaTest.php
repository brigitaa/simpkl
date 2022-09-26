<?php

namespace Tests\Feature\iterasi3;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;

class PengajuanSiswaTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tambah_pengajuan_pkl()
    {
        $siswa = User::where('role_id', '5')->first();

        Storage::fake('local');
        $filepernyataanortu = UploadedFile::fake()->create('file1.pdf');
        $filepernyataansiswa = UploadedFile::fake()->create('file2.pdf');

        $response = $this->actingAs($siswa)
                         ->post(route('pengajuanPKL.store'), [
                            'siswa_id'=>$siswa->id,
                            'periode_id'=>'3',
                            'dudi_id'=>'3',
                            'pernyataan_ortu'=>$filepernyataanortu,
                            'pernyataan_siswa'=>$filepernyataansiswa,
                           ]);
        $response->assertStatus(302);
    }

    public function test_lihat_riwayat_pengajuan_pkl() {
        $siswa = User::where('role_id', '5')->first();

        $response = $this->actingAs($siswa)->get(route('pengajuanPKL.index'));
        $response->assertStatus(200);
    }

    public function test_ubah_pengajuan_pkl()
    {
        $siswa = User::where('role_id', '5')->first();

        Storage::fake('local');
        $filepernyataanortu = UploadedFile::fake()->create('file3.pdf');
        $filepernyataansiswa = UploadedFile::fake()->create('file4.pdf');

        $response = $this->actingAs($siswa)
                         ->put(route('pengajuanPKL.update', 'P-0000000000005'), [
                            'periode_id'=>'3',
                            'dudi_id'=>'1',
                            'pernyataan_ortu'=>$filepernyataanortu,
                            'pernyataan_siswa'=>$filepernyataansiswa,
                           ]);
        $response->assertStatus(302);
    }

    public function test_hapus_pengajuan_pkl() {
        $siswa = User::where('role_id', '5')->first();

        $response = $this->actingAs($siswa)->delete(route('pengajuanPKL.destroy','P-0000000000001'));
        $response->assertStatus(302);
    }
}
