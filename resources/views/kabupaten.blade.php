@extends('layouts.main')

@section('container')
    <h1>{{ $title }}</h1>

    <form action="{{ route('kabupaten.index') }}" method="GET">
        <select name="provinsi" id="provinsi">
            <option value="default">Pilih Provinsi</option>
            @foreach($tabel_provinsi as $provinsi)
                <option value="{{ $provinsi->id }}">{{ $provinsi->nama_provinsi }}</option>
            @endforeach
        </select>

        <select name="kabupaten" id="kabupaten">
            <option value="default">Pilih Kabupaten</option>
        </select>

        <button type="submit">Filter</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kabupaten</th>
                <th>Provinsi</th>
                <th>Jumlah Penduduk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tabel_kabupaten as $index => $kabupaten)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $kabupaten->nama_kabupaten }}</td>
                    <td>{{ $kabupaten->provinsi->nama_provinsi }}</td>
                    <td>{{ $kabupaten->penduduks_count }}</td>
                    <td>
                        <a href="{{ route('kabupaten.edit', $kabupaten->id) }}">Edit</a> |
                        <form action="{{ route('kabupaten.destroy', $kabupaten->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('kabupaten.create') }}" class="btn btn-primary mb-3">Tambah Kabupaten</a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#provinsi').change(function() {
                var provinsiId = $(this).val();
                
                if (provinsiId && provinsiId != 'default') {
                    $.ajax({
                        type: "GET",
                        url: "/getKabupaten/" + provinsiId,
                        success: function(data) {
                            $('#kabupaten').empty();
                            $('#kabupaten').append('<option value="default">Pilih Kabupaten</option>');
                            $.each(data, function(key, value) {
                                $('#kabupaten').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#kabupaten').empty();
                    $('#kabupaten').append('<option value="default">Pilih Kabupaten</option>');
                }
            });
        });
    </script>
@endsection
