<?php

namespace Tests\Feature\iterasi1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;

class DataSiswaTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tambah_data_siswa()
    {
        $admin = User::where('role_id', '1')->first();

        $user = User::create([
            'name'=>'Siswa 5',
            'username'=>'siswa5',
            'email'=>'siswa5@gmail.com',
            'password' => Hash::make('siswa5'),
            'remember_token' => \Str::random(50),
            'role_id'=>'5'
        ]);

        $datasiswa = Siswa::create([
            'nis'=>'11185656',
            'nisn'=>'111810565656',
            'nama_siswa'=>'Siswa 5',
            'jeniskelamin'=>'Laki-laki',
            'alamat'=>'KM 15',
            'no_telp'=>'081209876543',
            'users_id'=>$user->id,
            'kode_kelas'=>'TKJ1',
            'kode_thn_ajaran'=>'001'
        ]);

        $response = $this->actingAs($admin)->get(route('datasiswaPKL.index'));
        $response->assertStatus(200);
    }

    public function test_import_data_siswa() {
        $admin = User::where('role_id', '1')->first();
        
        $file = UploadedFile::fake()->create('datasiswa.xlsx');
        Excel::fake();

        $response = $this->actingAs($admin)->post(route('datasiswaPKL.import'), [
            'file' => $file
        ]);

        Excel::assertImported('datasiswa.xlsx');
        $response->assertStatus(302);
    }

    public function test_lihat_manajemen_data_siswa() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->get(route('datasiswaPKL.index'));
        $response->assertStatus(200);
    }

    public function test_lihat_data_siswa() {
        $pokjapkl = User::where('role_id', '2')->first();

        $response = $this->actingAs($pokjapkl)->get(route('datasiswaPKL.lihat'));
        $response->assertStatus(200);
    }

    public function test_ubah_data_siswa()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->put(route('datasiswaPKL.update',10), [
                            'name'=>'Siswa 5',
                            'username'=>'siswake5',
                            'email'=>'siswa5@gmail.com',
                            'password' => Hash::make('siswa5'),
                            'remember_token' => \Str::random(50),
                            'role_id'=>'5',
                            'nis'=>'11185656',
                            'nisn'=>'111810565656',
                            'nama_siswa'=>'Siswa 5',
                            'jeniskelamin'=>'Laki-laki',
                            'alamat'=>'Jl. Ahmad Yani',
                            'no_telp'=>'081209876534',
                            'users_id'=>'23',
                            'kode_kelas'=>'TKJ1',
                            'kode_thn_ajaran'=>'001'
        ]);
        $response->assertStatus(302);  
    }

    public function test_hapus_data_siswa() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->delete(route('datasiswaPKL.destroy',10));
        $response->assertStatus(302);
    }
}
        