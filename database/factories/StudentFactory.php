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
            'nisn' => $this->faker->isbn10(),
            'nama' => $this->faker->name(),
            'kelas_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'jenis_kelamin' => $this->faker->randomElement($array = array('Laki-laki', 'Perempuan')),
        ];
    }
}
