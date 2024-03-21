<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Penduduk;
use App\Models\Kabupaten;
use Faker\Generator as Faker;

class PendudukFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Penduduk::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Nama' => $this->faker->name,
            'NIK' => $this->faker->numerify('###############'), // Generate random 15-digit number
            'Tanggal_Lahir' => $this->faker->date(),
            'Alamat' => $this->faker->address,
            'Jenis_Kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
        ];
    }
}
