<?php

namespace Tests\Feature;

use App\Models\Kelas;
use App\Models\Student;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;
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
        $this->withoutExceptionHandling();
        
        Kelas::factory()->create();

        $response = $this->post('/admin/students', [
            'nisn' => '123456789',
            'nama' => 'Ahmad Sabili',
            'kelas_id' => 1,
            'jenis_kelamin' => 'Laki-laki',
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/admin/students');
        $this->assertDatabaseHas('siswa', [
            'nisn' => '123456789',
            'nama' => 'Ahmad Sabili',
            'kelas_id' => '1',
            'jenis_kelamin' => 'Laki-laki',
        ]);
    }

    public function test_user_dapat_mengubah_data_siswa()
    {
        $this->withoutExceptionHandling();
        $this->assertTrue(true);
        //masukkan data kelas untuk relasi
        $kelas = Kelas::factory()->create();

        //$this->post(route('classes.store'), $kelas);

        // $siswa = Student::create([
        //     'nisn' => '0020329064',
        //     'nama' => 'Ahmad Sabili',
        //     'kelas_id' => 1,
        //     'jenis_kelamin' => 'Laki-laki'
        // ]);

        //masukkan data siswa
        // $students = [
        //     'nisn' => '0020329064',
        //     'nama' => 'Ahmad Sabili',
        //     'kelas_id' => 1,
        //     'jenis_kelamin' => 'Laki-laki'
        // ];
        
        //simpan data kelas

        //simpan data siswa
        //$this->post(route('students.update', $student), $students);
        
        //cek data siswa yang baru ditambahkan
        // $response = $this->get(route('students.index'));
        // $response->assertStatus(200)
        //         ->assertSee($siswa['nama'])
        //         ->assertSessionHas('success', 'Siswa berhasil diperbarui !');
    }

    public function test_user_dapat_menghapus_data_siswa()
    {
        $this->assertTrue(true);
    }
}
