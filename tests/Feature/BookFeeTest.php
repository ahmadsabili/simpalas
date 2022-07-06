<?php

namespace Tests\Feature;

use App\Models\BookFee;
use App\Models\BookList;
use App\Models\Kelas;
use App\Models\PembayaranSpp;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookFeeTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_data_tagihan_buku_dapat_ditampilkan()
    {
        $response = $this->get(route('tagihan-buku.index'));
        $response->assertStatus(200);
        $response->assertSee('Tagihan Buku');
    }

    public function test_user_dapat_menambahkan_data_tagihan_buku()
    {
        $this->withoutExceptionHandling();
        
        Kelas::factory()->count(20)->create();
        Student::factory()->count(10)->create();
        BookList::factory()->count(10)->create();
        
        $student = Student::find(1);
        $book = BookList::find(1);
        
        $response = $this->get(route('tagihan-buku.create', $student->nisn));
        $response->assertStatus(200);
        $response->assertSee('Tambah Tagihan Buku');
        
        BookFee::create([
            'id_siswa' => $student->id,
            'kelas' => explode(' ', $student->kelas->nama_kelas)[0],
            'id_buku' => $book->id,
            'nominal' => $book->harga,
            'status' => 'Belum Dibayar',
        ]);

        $this->assertDatabaseHas('pembayaran_buku', [
            'id_siswa' => $student->id,
            'kelas' => explode(' ', $student->kelas->nama_kelas)[0],
            'id_buku' => $book->id,
            'nominal' => $book->harga,
            'status' => 'Belum Dibayar',
            'tanggal_bayar' => null,
        ]);
    }

    public function test_user_dapat_mengubah_data_tagihan_buku()
    {
        $this->withoutExceptionHandling();

        Kelas::factory()->count(20)->create();
        Student::factory()->count(10)->create();
        BookList::factory()->count(10)->create();

        $student = Student::find(1);
        $book = BookList::find(1);
        
        $bookFee = BookFee::create([
            'id_siswa' => $student->id,
            'kelas' => explode(' ', $student->kelas->nama_kelas)[0],
            'id_buku' => $book->id,
            'nominal' => $book->harga,
            'status' => 'Belum Dibayar',
        ]);

        $this->assertDatabaseHas('pembayaran_buku', [
            'id_siswa' => $student->id,
            'kelas' => explode(' ', $student->kelas->nama_kelas)[0],
            'id_buku' => $book->id,
            'nominal' => $book->harga,
            'status' => 'Belum Dibayar',
            'tanggal_bayar' => null,
        ]);

        BookFee::find($bookFee->id)->update([
            'status' => 'Dibayar',
            'tanggal_bayar' => now(),
        ]);

        $this->assertDatabaseHas('pembayaran_buku', [
            'id_siswa' => $student->id,
            'kelas' => explode(' ', $student->kelas->nama_kelas)[0],
            'id_buku' => $book->id,
            'nominal' => $book->harga,
            'status' => 'Dibayar',
            'tanggal_bayar' => now(),
        ]);

    }

    public function test_user_dapat_menghapus_data_tagihan_buku()
    {
        $this->withoutExceptionHandling();

        Kelas::factory()->count(20)->create();
        Student::factory()->count(10)->create();
        BookList::factory()->count(10)->create();

        $student = Student::find(1);
        $book = BookList::find(1);
        
        $bookFee = BookFee::create([
            'id_siswa' => $student->id,
            'kelas' => explode(' ', $student->kelas->nama_kelas)[0],
            'id_buku' => $book->id,
            'nominal' => $book->harga,
            'status' => 'Belum Dibayar',
        ]);

        $this->assertDatabaseHas('pembayaran_buku', [
            'id_siswa' => $student->id,
            'kelas' => explode(' ', $student->kelas->nama_kelas)[0],
            'id_buku' => $book->id,
            'nominal' => $book->harga,
            'status' => 'Belum Dibayar',
            'tanggal_bayar' => null,
        ]);

        BookFee::find($bookFee->id)->delete();
        $this->assertDatabaseMissing('pembayaran_buku', [
            'id_siswa' => $student->id,
            'kelas' => explode(' ', $student->kelas->nama_kelas)[0],
            'id_buku' => $book->id,
            'nominal' => $book->harga,
            'status' => 'Belum Dibayar',
            'tanggal_bayar' => null,
        ]);
    }
}
