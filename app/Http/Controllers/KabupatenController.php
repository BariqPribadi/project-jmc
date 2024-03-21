<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KabupatenController extends Controller
{

    public function index(Request $request)
    {
        $provinsiId = $request->input('provinsi');
        $kabupatenId = $request->input('kabupaten');

        $query = Kabupaten::query();

        if ($provinsiId && $provinsiId != 'default') {
            $query->where('id_provinsi', $provinsiId);
        }

        if ($kabupatenId && $kabupatenId != 'default') {
            $query->where('id', $kabupatenId);
        }

        $tabel_kabupaten = $query->with('provinsi')->withCount('penduduks')->get();
        $tabel_provinsi = Provinsi::all();

        return view('kabupaten', [
            'title' => 'Data Kabupaten',
            'tabel_kabupaten' => $tabel_kabupaten,
            'tabel_provinsi' => $tabel_provinsi
        ]);
    }


    public function edit(Kabupaten $kabupaten)
    {
        $tabel_provinsi = Provinsi::all(); 
        return view('kabupaten_edit', compact('kabupaten', 'tabel_provinsi'), [
            'title' => 'Edit Data Kabupaten'
        ]);
    }

    public function update(Request $request, Kabupaten $kabupaten)
    {
        $kabupaten->nama_kabupaten = $request->nama_kabupaten;
        $kabupaten->id_provinsi = $request->id_provinsi;
        $kabupaten->save(); 

        return redirect()->route('kabupaten.index')->with('success', 'Kabupaten berhasil diperbarui.');
    }

    public function destroy(Kabupaten $kabupaten)
    {
        $kabupaten->delete();
        return redirect()->route('kabupaten.index')->with('success', 'Kabupaten berhasil dihapus.');
    }

    public function create()
    {
        $tabel_provinsi = Provinsi::all();
        return view('kabupaten_create', compact('tabel_provinsi'), [
            'title' => 'Tambah Data Kabupaten'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kabupaten' => 'required|string|max:255',
            'id_provinsi' => 'required|exists:provinsis,id'
        ]);

        Kabupaten::create([
            'nama_kabupaten' => $request->nama_kabupaten,
            'id_provinsi' => $request->id_provinsi
        ]);

        return redirect()->route('kabupaten.index')->with('success', 'Kabupaten berhasil ditambahkan.');
    }

}
