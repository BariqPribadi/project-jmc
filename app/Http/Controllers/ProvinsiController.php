<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    public function index()
    {
        $tabel_provinsi = Provinsi::withCount('kabupaten', 'penduduk')->get();
        return view('provinsi', [
            'title' => 'Data Provinsi',
            'tabel_provinsi' => $tabel_provinsi
        ]);
    }

    public function create()
    {
        return view('provinsi.create', [
            'title' => 'Tambah Data Provinsi'
        ]);
    }

    public function store(Request $request)
    {
        Provinsi::create([
            'nama_provinsi' => $request->nama_provinsi,
        ]);

        return redirect()->route('provinsi.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show(Provinsi $provinsi)
    {
        
    }

    public function edit(Provinsi $provinsi)
    {
        return view('provinsi.edit', [
            'title' => 'Edit Data Provinsi',
            'provinsi' => $provinsi
        ]);
    }

    public function update(Request $request, Provinsi $provinsi)
    {
        $provinsi->update([
            'nama_provinsi' => $request->nama_provinsi,
        ]);

        return redirect()->route('provinsi.index')->with('success', 'Provinsi berhasil diperbarui.');
    }

    public function destroy(Provinsi $provinsi)
    {
        $provinsi->delete();
        return redirect()->route('provinsi.index')->with('success', 'Provinsi berhasil dihapus.');
    }
}
