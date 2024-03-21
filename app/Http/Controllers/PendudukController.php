<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PendudukController extends Controller
{
    public function index(Request $request)
    {
        $query = Penduduk::query();

        if ($request->has('kabupaten')) {
            $query->where('id_kabupaten', $request->kabupaten);
        }

        if ($request->has('provinsi')) {
            $query->where('id_provinsi', $request->provinsi);
        }

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('Nama', 'like', '%' . $request->search . '%')
                ->orWhere('NIK', 'like', '%' . $request->search . '%');
            });
        }

        $tabel = $query->paginate(10);

        return view('home', [
            'title' => 'Data Penduduk',
            'tabel' => $tabel,
            'kabupatens' => Kabupaten::all(),
            'provinsis' => Provinsi::all(),
        ]);
    }

    public function export(Request $request)
    {
        $query = Penduduk::query();

        if ($request->has('kabupaten')) {
            $query->where('id_kabupaten', $request->kabupaten);
        }

        if ($request->has('provinsi')) {
            $query->where('id_provinsi', $request->provinsi);
        }

        $data = $query->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Nama');
        $sheet->setCellValue('B1', 'NIK');
        $sheet->setCellValue('C1', 'Tanggal Lahir');
        $sheet->setCellValue('D1', 'Alamat');
        $sheet->setCellValue('E1', 'Jenis Kelamin');
        $sheet->setCellValue('F1', 'Kabupaten');
        $sheet->setCellValue('G1', 'Provinsi');
        $sheet->setCellValue('H1', 'Timestamp');

        foreach ($data as $key => $penduduk) {
            $row = $key + 2;
            $sheet->setCellValue('A' . $row, $penduduk->Nama);
            $sheet->setCellValue('B' . $row, $penduduk->NIK);
            $sheet->setCellValue('C' . $row, $penduduk->Tanggal_Lahir);
            $sheet->setCellValue('D' . $row, $penduduk->Alamat);
            $sheet->setCellValue('E' . $row, $penduduk->Jenis_Kelamin);
            $sheet->setCellValue('F' . $row, $penduduk->kabupaten->nama_kabupaten);
            $sheet->setCellValue('G' . $row, $penduduk->provinsi->nama_provinsi);
            $sheet->setCellValue('H' . $row, $penduduk->Timestamp);
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data_penduduk.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $tabel = Penduduk::query()
            ->where('Nama', 'LIKE', "%$keyword%")
            ->orWhere('NIK', 'LIKE', "%$keyword%")
            ->get();

        return view('home', [
            'title' => 'Data Penduduk',
            'tabel' => $tabel,
            'kabupatens' => Kabupaten::all(),
            'provinsis' => Provinsi::all(),
        ]);
    }


    
    public function about()
    {
        return view('welcome', [
            'title' => 'About'
        ]);
    }

    
    public function edit($id)
    {
        $penduduk = Penduduk::findOrFail($id);
        $kabupatens = Kabupaten::all(); 
        $provinsis = Provinsi::all(); 
        return view('edit', compact('penduduk', 'kabupatens', 'provinsis'), [
            'title' => 'Edit Data Penduduk'
        ]);
    }

    public function update(Request $request, $id)
    {
        $penduduk = Penduduk::findOrFail($id);

        $penduduk->update([
            'Nama' => $request->nama,
            'NIK' => $request->nik,
            'Tanggal_Lahir' => $request->tanggal_lahir,
            'Alamat' => $request->alamat,
            'Jenis_Kelamin' => $request->jenis_kelamin,
            'id_kabupaten' => $request->id_kabupaten,
            'id_provinsi' => $request->id_provinsi,
        ]);

        return redirect()->route('home')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penduduk = Penduduk::findOrFail($id);
        $penduduk->delete();
        return redirect()->back()->with('message', 'Data berhasil dihapus.');
    }

    public function create()
    {
        $kabupatens = Kabupaten::all(); 
        $provinsis = Provinsi::all(); 
        return view('tambah', [
            'title' => 'Tambah Data Penduduk',
            'kabupatens' => $kabupatens,
            'provinsis' => $provinsis,
        ]);
    }

    public function store(Request $request)
    {
        Penduduk::create([
            'Nama' => $request->nama,
            'NIK' => $request->nik,
            'Tanggal_Lahir' => $request->tanggal_lahir,
            'Alamat' => $request->alamat,
            'Jenis_Kelamin' => $request->jenis_kelamin,
            'id_kabupaten' => $request->id_kabupaten,
            'id_provinsi' => $request->id_provinsi,
        ]);

        return redirect()->route('home')->with('success', 'Data berhasil ditambahkan.');
    }

    public function getKabupaten($id)
    {
        $kabupatens = Kabupaten::where('id_provinsi', $id)->get()->pluck('nama_kabupaten', 'id');
        return $kabupatens;
    }

}
