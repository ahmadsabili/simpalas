<?php

namespace Tests\Feature;

use App\Models\Kelas;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_halaman_dashboard_admin_dapat_dikunjungi()
    {
        $response = $this->get('/admin');
        $response->assertStatus(200);
    }

    public function test_data_dashboard_admin_dapat_ditampilkan()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('admin.index'));
        $response->assertStatus(200);

        Kelas::factory()->count(20)->create();
        Student::factory()->count(10)->create();
        $student = Student::count();
        $class = Kelas::count();
        $user_spp = User::where('role', 'spp')->count();
        $user_buku = User::where('role', 'buku')->count();

        $response->assertSee('Dashboard');

        $response->assertSee('Siswa');
        $response->assertSee($student);

        $response->assertSee('Kelas');
        $response->assertSee($class);

        $response->assertSee('User SPP');
        $response->assertSee($user_spp);

        $response->assertSee('User Buku');
        $response->assertSee($user_buku);
    }
}
