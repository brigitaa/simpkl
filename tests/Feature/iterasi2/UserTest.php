<?php

namespace Tests\Feature\iterasi2;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tambah_data_user()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->post(route('manajemenuser.store'), [
                            'name'=>'tata usaha 2',
                            'username'=>'tatausaha2',
                            'email'=>'tu2@gmail.com',
                            'password' => Hash::make('tatausaha2'),
                            'remember_token' => \Str::random(50),
                            'role_id'=>'4',
                           ]);
        $response->assertStatus(302);
    }

    public function test_lihat_manajemen_data_user() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->get(route('manajemenuser.index'));
        $response->assertStatus(200);
    }

    public function test_ubah_data_user()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->put(route('manajemenuser.update', '16'), [
                            'name'=>'TU 5',
                            'username'=>'tatausaha5',
                            'email'=>'tu2@gmail.com',
                            'password' => Hash::make('tatausaha5'),
                            'remember_token' => \Str::random(50),
                            'role_id'=>'4',
                           ]);
        $response->assertStatus(302);
    }

    public function test_hapus_data_user() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->delete(route('manajemenuser.destroy',16));
        $response->assertStatus(302);
    }
}
