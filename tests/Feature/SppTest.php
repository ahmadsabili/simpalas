<?php

namespace Tests\Feature;

use App\Models\Spp;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SppTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_data_spp_dapat_ditampilkan()
    {
        $response = $this->get(route('spp.daftar.index'));
        $response->assertStatus(200);
    }

    public function test_user_dapat_menambahkan_data_spp()
    {
        $response = $this->get(route('spp.daftar.create'));
        $response->assertStatus(200);
        $response->assertSee('Daftar SPP');

        $spp = Spp::create([
            'tahun_ajaran' => '2020/2021',
            'kelas' => 'XII',
            'nominal' => 100000
        ]);
        $this->assertDatabaseHas('spp', [
            'tahun_ajaran' => '2020/2021',
            'kelas' => 'XII',
            'nominal' => 100000
        ]);
    }

    public function test_user_dapat_mengubah_data_spp()
    {
        $this->withoutExceptionHandling();

        $spp = Spp::create([
            'tahun_ajaran' => '2020/2021',
            'kelas' => 'XII',
            'nominal' => 100000
        ]);
        $this->assertDatabaseHas('spp', [
            'tahun_ajaran' => '2020/2021',
            'kelas' => 'XII',
            'nominal' => 100000
        ]);
        $response = $this->get(route('spp.daftar.edit', $spp->id));
        $response->assertStatus(200);

        $spp->update([
            'tahun_ajaran' => '2020/2021',
            'kelas' => 'XII',
            'nominal' => 200000
        ]);
        $this->assertDatabaseHas('spp', [
            'tahun_ajaran' => '2020/2021',
            'kelas' => 'XII',
            'nominal' => 200000
        ]);
    }

    public function test_user_dapat_menghapus_data_spp()
    {
        $this->withoutExceptionHandling();
        $spp = Spp::create([
            'tahun_ajaran' => '2020/2021',
            'kelas' => 'XII',
            'nominal' => 100000
        ]);
        $this->assertDatabaseHas('spp', [
            'tahun_ajaran' => '2020/2021',
            'kelas' => 'XII',
            'nominal' => 100000
        ]);

        Spp::find($spp->id)->delete();
        $this->assertDatabaseMissing('spp', [
            'tahun_ajaran' => '2020/2021',
            'kelas' => 'XII',
            'nominal' => 100000
        ]);
    }
}
