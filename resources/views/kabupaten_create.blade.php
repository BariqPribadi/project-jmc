@extends('layouts.main')

@section('container')
    <h1>{{ $title }}</h1>
    <form action="{{ route('kabupaten.store') }}" method="POST">
        @csrf
        <label for="nama_kabupaten">Nama Kabupaten:</label>
        <input type="text" name="nama_kabupaten" value="{{ old('nama_kabupaten') }}">
        @error('nama_kabupaten')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <label for="id_provinsi">Provinsi:</label>
        <select name="id_provinsi">
            @foreach($tabel_provinsi as $provinsi)
                <option value="{{ $provinsi->id }}">{{ $provinsi->nama_provinsi }}</option>
            @endforeach
        </select>
        @error('id_provinsi')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <button type="submit">Tambah</button>
    </form>
@endsection