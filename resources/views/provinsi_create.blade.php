@extends('layouts.main')

@section('container')
    <h1>{{ $title }}</h1>
    <form action="{{ route('provinsi.store') }}" method="POST">
        @csrf
        <label for="nama_provinsi">Nama Provinsi:</label>
        <input type="text" name="nama_provinsi" id="nama_provinsi">
        <button type="submit">Simpan</button>
    </form>
@endsection
