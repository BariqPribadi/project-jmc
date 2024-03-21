<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use Faker\Generator as Faker;

class KabupatenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kabupaten::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Ambil provinsi yang sudah ada dari database
        $provinsi = Provinsi::inRandomOrder()->first();

        return [
            'nama_kabupaten' => $this->faker->unique()->city,
            'id_provinsi' => $provinsi->id,
        ];
    }
}