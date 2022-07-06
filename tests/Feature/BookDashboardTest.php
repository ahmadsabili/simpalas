<?php

namespace Tests\Feature;

use App\Models\BookFee;
use App\Models\BookList;
use App\Models\Kelas;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookDashboardTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_halaman_dashboard_buku_dapat_dikunjungi()
    {
        $response = $this->get(route('buku.index'));
        $response->assertStatus(200);
        $response->assertSee('Dashboard');
    }

    public function test_data_dashboard_buku_dapat_ditampilkan()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('buku.index'));
        $response->assertStatus(200);
        $response->assertSee('Dashboard');

        Kelas::factory()->count(20)->create();
        Student::factory()->count(10)->create();
        $student = Student::count();

        // $response->assertSee('Siswa');
        // $response->assertSee($student);

        $sumToday = BookFee::whereDate('tanggal_bayar', Carbon::today())->sum('nominal');
        $response->assertSee('Penerimaan Hari Ini');
        $response->assertSee($sumToday);

        $sumMonth = BookFee::whereMonth('tanggal_bayar', Carbon::today())->sum('nominal');
        $response->assertSee($sumMonth);

        $bookList = BookList::count();
        $response->assertSee('Jumlah Buku');
        $response->assertSee($bookList);
    }
}
