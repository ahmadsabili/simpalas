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

        Kelas::factory()->count(10)->create();
        
        // $response = $this->get(route('students.create'));
        // $response->assertStatus(200);

        Student::create([
            'nisn' => '123456789',
            'nama' => 'Ahmad Sabili',
            'kelas_id' => 1,
            'jenis_kelamin' => 'Laki-laki',
        ]);
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

        
        Kelas::factory()->count(10)->create();
        
        Student::create([
            'nisn' => '123456789',
            'nama' => 'Ahmad Sabili',
            'kelas_id' => 1,
            'jenis_kelamin' => 'Laki-laki',
        ]);

        $student = $this->assertDatabaseHas('siswa', [
            'nisn' => '123456789',
            'nama' => 'Ahmad Sabili',
            'kelas_id' => '1',
            'jenis_kelamin' => 'Laki-laki',
        ]);
        
        // $response = $this->get(route('students.edit', $student->id));
        // $response->assertStatus(200);

        Student::find(1)->update([
            'nisn' => '987654321',
            'nama' => 'Budi Santoso',
            'kelas_id' => 2,
            'jenis_kelamin' => 'Laki-laki',
        ]);

        $this->assertDatabaseHas('siswa', [
            'nisn' => '987654321',
            'nama' => 'Budi Santoso',
            'kelas_id' => '2',
            'jenis_kelamin' => 'Laki-laki',
        ]);
    }

    public function test_user_dapat_menghapus_data_siswa()
    {
        Kelas::factory()->count(10)->create();

        Student::create([
            'nisn' => '123456789',
            'nama' => 'Ahmad Sabili',
            'kelas_id' => 1,
            'jenis_kelamin' => 'Laki-laki',
        ]);
        $this->assertDatabaseHas('siswa', [
            'nisn' => '123456789',
            'nama' => 'Ahmad Sabili',
            'kelas_id' => '1',
            'jenis_kelamin' => 'Laki-laki',
        ]);

        Student::find(1)->delete();
        $this->assertDatabaseMissing('siswa', [
            'nisn' => '123456789',
            'nama' => 'Ahmad Sabili',
            'kelas_id' => '1',
            'jenis_kelamin' => 'Laki-laki',
        ]);
    }
}
