@extends('layouts.main')

@section('container')
    <h1>{{ $title }}</h1>
    <form action="{{ route('kabupaten.update', $kabupaten->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nama_kabupaten">Nama Kabupaten:</label>
        <input type="text" name="nama_kabupaten" value="{{ $kabupaten->nama_kabupaten }}">
        
        <label for="id_provinsi">Provinsi:</label>
        <select name="id_provinsi">
            @foreach($tabel_provinsi as $provinsi)
                <option value="{{ $provinsi->id }}" {{ $kabupaten->id_provinsi == $provinsi->id ? 'selected' : '' }}>{{ $provinsi->nama_provinsi }}</option>
            @endforeach
        </select>
        
        <button type="submit">Update</button>
    </form>
@endsection
