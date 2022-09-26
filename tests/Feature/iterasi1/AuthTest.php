<?php

namespace Tests\Feature\iterasi1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;


class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_admin()
    {
        $user = User::where('role_id', '1')->first();
        $response = $this->post('/post-login', [
            'username' => $user->username,
            'password' => 'admin'
        ]);

        // $response->assertStatus(302);
        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard.index'));
        // $response->assertStatus(200);
    }

    public function test_login_pokja_pkl()
    {
        $user = User::where('role_id', '2')->first();
        $response = $this->post('/post-login', [
            'username' => $user->username,
            'password' => 'pokja'
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard.index'));
    }

    public function test_login_kaprog()
    {
        $response = $this->post('/post-login', [
            'username' => 'kaprogtki',
            'password' => 'kaprogtki'
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard.kaprog'));
    }

    public function test_login_tata_usaha()
    {
        $user = User::where('role_id', '4')->first();
        $response = $this->post('/post-login', [
            'username' => 'tatausaha',
            'password' => 'tatausaha'
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard.index'));
    }

    public function test_login_siswa()
    {
        $response = $this->post('/post-login', [
            'username' => 'siswa',
            'password' => 'Siswa1'
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard.siswa'));
    }

    public function test_logout()
    {
        $user = User::where('role_id', '1')->first();
        
        $this->actingAs($user);;

        $response = $this->get('/logout');

        $response->assertRedirect('/');

    }
}
