@extends('layouts.main')

@section('container')
    <h1>{{ $title }}</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Provinsi</th>
                <th>Jumlah Kabupaten</th>
                <th>Jumlah Penduduk</th> 
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tabel_provinsi as $index => $data)
            <tr>
                <td>{{ $index + 1}}</td>
                <td>{{ $data->nama_provinsi }}</td>
                <td>{{ $data->kabupaten_count }}</td>
                <td>{{ $data->penduduk_count }}</td> 
                <td>
                    <a href="{{ route('provinsi.edit', $data->id) }}">Edit</a> |
                    <form action="{{ route('provinsi.destroy', $data->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('provinsi.create') }}" class="btn btn-primary">Tambah Provinsi</a>
@endsection
