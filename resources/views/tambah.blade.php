@extends('layouts/main')

@section('container')
    <h1>{{ $title }}</h1>

    <form action="{{ route('store') }}" method="POST">
        @csrf
        <input type="text" name="nama" placeholder="Nama">
        <input type="text" name="nik" placeholder="NIK">
        <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir">
        <input type="text" name="alamat" placeholder="Alamat">
        <select name="jenis_kelamin">
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
        <select name="id_provinsi" id="id_provinsi">
            <option value="">Pilih Provinsi</option>
            @foreach($provinsis as $provinsi)
                <option value="{{ $provinsi->id }}">{{ $provinsi->nama_provinsi }}</option>
            @endforeach
        </select>
        <select name="id_kabupaten">
            <option value="">Pilih Kabupaten</option>
        </select>
        <button type="submit">Tambah</button>
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