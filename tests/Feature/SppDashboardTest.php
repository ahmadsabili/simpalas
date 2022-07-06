<?php

namespace Tests\Feature;

use App\Models\Kelas;
use App\Models\PembayaranSpp;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SppDashboardTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_halaman_dashboard_spp_dapat_dikunjungi()
    {
        $response = $this->get(route('spp.index'));
        $response->assertStatus(200);
    }

    public function test_data_dashboard_spp_dapat_ditampilkan()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('spp.index'));
        $response->assertStatus(200);

        Kelas::factory()->count(20)->create();
        Student::factory()->count(10)->create();
        $student = Student::count();

        $response->assertSee('Dashboard');

        $response->assertSee('Siswa');
        $response->assertSee($student);

        $sumToday = PembayaranSpp::whereDate('updated_at', Carbon::today())->sum('nominal');
        $response->assertSee($sumToday);

        $sumMonth = PembayaranSpp::whereMonth('updated_at', Carbon::today())->sum('nominal');
        $response->assertSee($sumMonth);
    }
}
