@extends('layouts.main')

@section('container')
    <h1>Edit Data Provinsi</h1>
    <form action="{{ route('provinsi.update', $provinsi->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nama_provinsi">Nama Provinsi:</label>
        <input type="text" name="nama_provinsi" value="{{ $provinsi->nama_provinsi }}">
        <button type="submit">Update</button>
    </form>
@endsection
