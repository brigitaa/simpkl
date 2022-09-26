<?php

namespace Tests\Feature\iterasi5;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;

class GuruMonitoringTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_lihat_data_guru_monitoring() {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)->get(route('gurumonitoring.index'));
        $response->assertStatus(200);
    }

    public function test_ubah_data_guru_monitoring()
    {
        $admin = User::where('role_id', '1')->first();

        $response = $this->actingAs($admin)
                         ->put(route('gurumonitoring.update', '1'), [
                            'guru_id'=>'5'
                           ]);
        $response->assertStatus(302);
    }
}
