<?php

namespace Tests\Feature;

use App\Models\BookFee;
use App\Models\BookList;
use App\Models\Kelas;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookHistoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_halaman_riwayat_pembayaran_buku_dapat_dikunjungi()
    {
        $response = $this->get(route('tagihan-buku.riwayat.index'));
        $response->assertStatus(200);
        $response->assertSee('Riwayat Pembayaran Buku');
    }

    public function test_data_pembayaran_buku_dapat_ditampilkan()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('tagihan-buku.riwayat.index'));
        $response->assertStatus(200);

        Kelas::factory()->count(20)->create();
        Student::factory()->count(10)->create();
        BookList::factory()->count(10)->create();

        $pembayaran = BookFee::create([
            'id_siswa' => 1,
            'kelas' => explode(' ', Student::find(1)->kelas->nama_kelas)[0],
            'id_buku' => 1,
            'nominal' => BookList::find(1)->harga,
            'status' => 'Belum Dibayar',
        ]);
        
        $pembayaranBuku = BookFee::with('siswa', 'buku')->first();
    }
}
