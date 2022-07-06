<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookList>
 */
class BookListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'judul' => $this->faker->name(),
            'kelas' => $this->faker->randomElement($array = array('X', 'XI', 'XII')),
            'harga' => $this->faker->numberBetween($min = 10000, $max = 100000),
        ];
    }
}
