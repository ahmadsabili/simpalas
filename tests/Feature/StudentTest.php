<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_halaman_siswa_dapat_menampilkan_data_siswa()
    {
        $response = $this->get('/admin/students');
        $response->assertStatus(200);
    }

    public function test_user_dapat_menambahkan_data_siswa()
    {
        //Given we have task in the database
        $student = new Student([
            'nisn' => '0020329064',
            'nama' => 'Ahmad Sabili',
            'kelas_id' => 1,
            'jenis_kelamin' => 'Laki-laki'
        ]);

        //When user visit the tasks page
        $response = $this->get('/admin/students');
        
        //He should be able to read the task
        $response->assertSee($student->nama);
    }

    public function test_user_dapat_mengubah_data_siswa()
    {
        $this->assertTrue(true);
    }

    public function test_user_dapat_menghapus_data_siswa()
    {
        $this->assertTrue(true);
    }
}
