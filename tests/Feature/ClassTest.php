<?php

namespace Tests\Feature;

use App\Models\Kelas;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ClassTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_halaman_kelas_dapat_menampilkan_data_kelas()
    {
        $response = $this->get('/admin/classes');
        $response->assertStatus(200);
    }

    public function test_user_dapat_menambahkan_data_kelas()
    {
        $this->withoutExceptionHandling();

        Kelas::create([
            'nama_kelas' => 'XI RPL 1',
        ]);

        $this->assertDatabaseHas('kelas', [
            'nama_kelas' => 'XI RPL 1',
        ]);
    }

    public function test_user_dapat_mengubah_data_kelas()
    {
        Kelas::create([
            'nama_kelas' => 'XI RPL 1',
        ]);

        $this->assertDatabaseHas('kelas', [
            'nama_kelas' => 'XI RPL 1',
        ]);

        Kelas::find(1)->update([
            'nama_kelas' => 'XI RPL 2',
        ]);
        $this->assertDatabaseHas('kelas', [
            'nama_kelas' => 'XI RPL 2',
        ]);
    }

    public function test_user_dapat_menghapus_data_kelas()
    {
        Kelas::create([
            'nama_kelas' => 'XI RPL 1',
        ]);

        $this->assertDatabaseHas('kelas', [
            'nama_kelas' => 'XI RPL 1',
        ]);

        Kelas::find(1)->delete();
    }
}
