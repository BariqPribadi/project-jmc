<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('provinsis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_provinsi')->unique(); // Menambahkan constraint unik
            $table->timestamps();
        });

        Schema::create('kabupatens', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kabupaten')->unique();
            $table->unsignedBigInteger('id_provinsi');
            $table->timestamps();

            $table->unique(['nama_kabupaten', 'id_provinsi']);

            $table->foreign('id_provinsi')->references('id')->on('provinsis')->onDelete('cascade');
        });

        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->string('Nama');
            $table->unsignedBigInteger('NIK')->length(18)->nullable();
            $table->date('Tanggal_Lahir');
            $table->string('Alamat');
            $table->enum('Jenis_Kelamin', ['Laki-laki', 'Perempuan']);
            $table->unsignedBigInteger('id_kabupaten')->nullable();
            $table->unsignedBigInteger('id_provinsi')->nullable();
            $table->timestamp('Timestamp')->useCurrent();
            $table->timestamps();

            $table->foreign('id_kabupaten')->references('id')->on('kabupatens')->onDelete('cascade');
            $table->foreign('id_provinsi')->references('id')->on('provinsis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduks');
        Schema::dropIfExists('kabupatens');
        Schema::dropIfExists('provinsis');
    }
};