<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    // protected $fillable = ['Nama', 'NIK', 'Tanggal_Lahir', 'Alamat', 'Jenis_Kelamin' ];
    protected $guarded = ['id', 'Timestamp'];

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten')->withDefault();
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi');
    }
}
