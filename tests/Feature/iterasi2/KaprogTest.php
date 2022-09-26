<?php

namespace Tests\Feature\iterasi2;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;
use App\Models\Kaprog;

class KaprogTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tambah_data_kaprog()
    {
        $admin = User::where('role_id', '1')->first();

        $user = User::create([
            'name'=>'kaprog bdp',
            'username'=>'kaprogbdp',
            'email'=>'kaprobdp@gmail.com',
            'password' => Hash::make('kaprogbdp'),
            'remember_token' => \Str::random(50),
            'role_id'=>'3'
        ]);

        $datakaprog = Kaprog::create([
            'nip'=>'2222222222',
            'nama_kaprog'=>'kaprog bdp',
            'users_id'=>$user->id,
            'kompetensi_keahlian_id'=>'3'
        ]);

        $response = $this->actingAs($admin)->get(route('kaprog.index'));
        $response->assertStatus(200);
    }

    public function test_lihat_manajemen_data_kaprog() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->get(route('kaprog.index'));
        $response->assertStatus(200);
    }

    public function test_ubah_data_kaprog()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->put(route('kaprog.update', '4'), [
                            'name'=>'kaprog bdpku',
                            'username'=>'kaprogbdp',
                            'email'=>'kaprogbdp@mail.com',
                            'password' => Hash::make('kaprogbdp'),
                            'remember_token' => \Str::random(50),
                            'role_id'=>'3',
                            'nip'=>'55555555555',
                            'nama_kaprog'=>'kaprog bdpku',
                            'users_id'=>'15',
                            'kompetensi_keahlian_id'=>'3'
                           ]);
        $response->assertStatus(302);
    }

    public function test_hapus_data_kaprog() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->delete(route('kaprog.destroy',4));
        $response->assertStatus(302);
    }
}
