<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nisn' => $this->faker->unique()->sentence(3),
            'nama' => $this->faker->name(),
            'kelas' => $this->faker->sentence(),
            'jenis_kelamin' => $this->faker->sentence(),
            'alamat' => $this->faker->sentence(),
            'tahun_ajaran' => $this->faker->sentence()
        ];
    }
}
