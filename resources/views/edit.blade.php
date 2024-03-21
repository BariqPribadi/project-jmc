@extends('layouts/main')

@section('container')
    <h1>{{ $title }}</h1>

    <form action="{{ route('update', $penduduk->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="nama" value="{{ $penduduk->Nama }}" placeholder="Nama">
        <input type="text" name="nik" value="{{ $penduduk->NIK }}" placeholder="NIK">
        <input type="date" name="tanggal_lahir" value="{{ $penduduk->Tanggal_Lahir }}" placeholder="Tanggal Lahir">
        <input type="text" name="alamat" value="{{ $penduduk->Alamat }}" placeholder="Alamat">
        <select name="jenis_kelamin">
            <option value="Laki-laki" {{ $penduduk->Jenis_Kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ $penduduk->Jenis_Kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
        <select name="id_provinsi" id="id_provinsi">
            @foreach($provinsis as $provinsi)
                <option value="{{ $provinsi->id }}" {{ $penduduk->provinsi->id == $provinsi->id ? 'selected' : '' }}>{{ $provinsi->nama_provinsi }}</option>
            @endforeach
        </select>
        <select name="id_kabupaten" id="id_kabupaten">
            @foreach($kabupatens as $kabupaten)
                <option value="{{ $kabupaten->id }}" {{ $penduduk->kabupaten->id == $kabupaten->id ? 'selected' : '' }}>{{ $kabupaten->nama_kabupaten }}</option>
            @endforeach
        </select>
        <button type="submit">Update</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('select[name="id_provinsi"]').on('change', function(){
                var id_provinsi = $(this).val();
                if(id_provinsi){
                    $.ajax({
                        url: '/getKabupaten/'+id_provinsi,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data){
                            $('select[name="id_kabupaten"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="id_kabupaten"]').append('<option value="'+key+'">'+value+'</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="id_kabupaten"]').empty();
                }
            });
        });
    </script>
@endsection