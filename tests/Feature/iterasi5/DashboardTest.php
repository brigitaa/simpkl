<?php

namespace Tests\Feature\iterasi5;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;

class DashboardTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_lihat_dashboard_admin_pokjapkl_tatausaha() {
        $user = User::where('role_id', '1')
                    ->orWhere('role_id', '2')
                    ->orWhere('role_id', '4')
                    ->first();

        $response = $this->actingAs($user)->get(route('dashboard.index'));
        $response->assertStatus(200);
    }

    public function test_lihat_dashboard_kaprog() {
        $kaprog = User::where('role_id', '3')->first();

        $response = $this->actingAs($kaprog)->get(route('dashboard.kaprog'));
        $response->assertStatus(200);
    }

    public function test_lihat_dashboard_siswa() {
        $siswa = User::where('role_id', '5')->first();

        $response = $this->actingAs($siswa)->get(route('dashboard.siswa'));
        $response->assertStatus(200);
    }
}
