<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Penduduk;

class PendudukSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Dapatkan semua kabupaten yang tersedia dari database
        $kabupatenIds = Kabupaten::pluck('id');

        // Buat 30 penduduk baru dengan menggunakan kabupaten yang dipilih secara acak
        for ($i = 0; $i < 30; $i++) {
            // Pilih secara acak satu kabupaten yang belum pernah digunakan sebelumnya
            $randomKabupatenId = $kabupatenIds->random();

            // Buat penduduk baru dengan menggunakan kabupaten yang dipilih secara acak
            Penduduk::factory()->create([
                'id_kabupaten' => $randomKabupatenId,
                'id_provinsi' => Kabupaten::find($randomKabupatenId)->id_provinsi, // Ambil ID provinsi dari kabupaten yang dipilih
            ]);
        }
    }
}