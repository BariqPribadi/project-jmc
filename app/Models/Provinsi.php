<?php

namespace App\Models;

use App\Models\Kabupaten;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Penduduk;

class Provinsi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $fillable = ['nama_provinsi'];

    public function kabupaten()
    {
        return $this->hasMany(Kabupaten::class, 'id_provinsi');
    }

    public function penduduk()
    {
        return $this->hasMany(Penduduk::class, 'id_provinsi');
    }
}
