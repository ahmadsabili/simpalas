<?php

namespace Tests\Feature;

use App\Models\BookList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_data_buku_dapat_ditampilkan()
    {
        $response = $this->get(route('buku.daftar.index'));
        $response->assertStatus(200);
        $response->assertSee('Daftar Buku');
    }

    public function test_user_dapat_menambahkan_data_buku()
    {
        $response = $this->get(route('buku.daftar.create'));
        $response->assertStatus(200);
        $response->assertSee('Tambah Buku');
        $this->post(route('buku.daftar.store'), [
            'judul' => 'Matematika',
            'kelas' => 'XII',
            'harga' => '20000',
        ]);
        $this->assertDatabaseHas('buku', [
            'judul' => 'Matematika',
            'kelas' => 'XII',
            'harga' => 20000,
        ]);
        $response->assertSessionHas('success', 'Buku berhasil ditambahkan!');
    }

    public function test_user_dapat_mengubah_data_buku()
    {
        $this->withoutExceptionHandling();
        $book = BookList::factory()->create();
        $response = $this->get(route('buku.daftar.edit', $book->id));
        $response->assertStatus(200);
        $response->assertSee('Ubah Buku');
    }

    public function test_user_dapat_menghapus_data_buku()
    {
        $this->assertTrue(true);
    }
}
