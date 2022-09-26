<?php

namespace Tests\Feature\iterasi5;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;

class ProfilTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_ubah_profil_admin()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->put(route('profil.update', '1'), [
                            'name'=>'Admin 1',
                            'username'=>'admin1',
                            'remember_token' => \Str::random(50)
                           ]);
        $response->assertStatus(302);
    }

    public function test_ubah_profil_pokja_pkl()
    {
        $pokjapkl = User::where('role_id', '2')->first();

        $response = $this->actingAs($pokjapkl)
                         ->put(route('profil.update', '9'), [
                            'name'=>'Ketua Pokja PKL',
                            'username'=>'pokja',
                            'remember_token' => \Str::random(50)
                           ]);
        $response->assertStatus(302);
    }

    public function test_ubah_profil_kaprog()
    {
        $kaprog = User::where('role_id', '3')->first();

        $response = $this->actingAs($kaprog)
                         ->put(route('profil.update', '9'), [
                            'name'=>'Kaprog TKI',
                            'username'=>'kaprogtki',
                            'remember_token' => \Str::random(50),
                            'nip'=>'11290876653',
                            'nama_kaprog'=>'Kaprog TKI',
                           ]);
        $response->assertStatus(302);
    }

    public function test_ubah_profil_tata_usaha()
    {
        $tatausaha = User::where('role_id', '4')->first();

        $response = $this->actingAs($tatausaha)
                         ->put(route('profil.update', '10'), [
                            'name'=>'Tata Usaha',
                            'username'=>'tatausaha',
                            'remember_token' => \Str::random(50)
                           ]);
        $response->assertStatus(302);
    }

    public function test_ubah_profil_siswa()
    {
        $siswa = User::where('role_id', '5')->first();

        $response = $this->actingAs($siswa)
                         ->put(route('profil.update', '2'), [
                            'name'=>'Brigita',
                            'username'=>'siswa',
                            'password' => Hash::make('Siswa1'),
                            'remember_token' => \Str::random(50),
                            'nis'=>'11181020',
                            'nisn'=>'1118102020',
                            'nama_siswa'=>'Brigita',
                            'jeniskelamin'=>'Perempuan',
                            'alamat'=>'Jl. Satu',
                            'no_telp'=>'082312345678',
                           ]);
        $response->assertStatus(302);
    }
}
