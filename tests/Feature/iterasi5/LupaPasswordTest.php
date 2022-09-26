<?php

namespace Tests\Feature\iterasi5;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Carbon\Carbon; 
use App\Models\User;
use DB; 

class LupaPasswordTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store_lupa_password_form()
    {
        $user = User::where('role_id', '5')->first();
        $response = $this->post(route('post.lupapassword'), [
                            'email' => $user->email
                           ]);
        $response->assertStatus(302);
    }

    public function test_store_reset_password_form()
    {
        $user = User::where('role_id', '5')->first();

        $token = DB::table('password_resets')
                    ->where([
                        'email' => $user->email
                    ])
                    ->first();

        $response = $this->post(route('post.resetpassword'), [
                            'token' => $token->token,
                            'email' => $user->email,
                            'password' => 'Siswa1',
                            'password_confirmation' => 'Siswa1'
                           ]);

        $response->assertStatus(302);
    }
}
