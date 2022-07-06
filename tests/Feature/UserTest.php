<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_halaman_user_dapat_menampilkan_data_user()
    {
        $response = $this->get(route('users.index'));
        $response->assertStatus(200);
    }

    public function test_admin_dapat_menambahkan_data_user()
    {
        $this->withoutExceptionHandling();

        User::create([
            'name' => 'Ahmad Sabili',
            'email' => 'ahmadsabili@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Ahmad Sabili',
            'email' => 'ahmadsabili@gmail.com',
            'role' => 'admin',
        ]);
    }

    // public function test_admin_dapat_mengubah_data_user()
    // {
    //     $this->withoutExceptionHandling();

    //     User::create([
    //         'name' => 'Ahmad Sabili',
    //         'email' => 'ahmadsabili@gmail.com',
    //         'password' => bcrypt('password'),
    //         'role' => 'admin',
    //     ]);

    //     $this->assertDatabaseHas('users', [
    //         'name' => 'Ahmad Sabili',
    //         'email' => 'ahmadsabili@gmail.com',
    //         'role' => 'admin',
    //     ]);

    //     User::find(1)->update([
    //         'name' => 'Ahmad Sabilillah',
    //     ]);

    //     $this->assertDatabaseHas('users', [
    //         'name' => 'Ahmad Sabilillah',
    //         'email' => 'ahmadsabili@gmail.com',
    //         'role' => 'admin',
    //     ]);
    // }

    public function test_admin_dapat_menghapus_data_user()
    {
        $this->withoutExceptionHandling();

        User::create([
            'name' => 'Ahmad Sabili',
            'email' => 'ahmadsabili@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Ahmad Sabili',
            'email' => 'ahmadsabili@gmail.com',
            'role' => 'admin',
        ]);

        User::find(1)->delete();
        $this->assertDatabaseMissing('users', [
            'email' => 'ahmadsabili@gmail.com',
        ]);
    }
}
