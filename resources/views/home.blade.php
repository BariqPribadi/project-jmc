@extends('layouts.main')

@section('container')
    <h1>{{ $title }}</h1>

    <div>
        <form action="{{ route('home') }}" method="GET">
            <div>
                <label for="provinsi">Pilih Provinsi:</label>
                <select name="provinsi" id="provinsi">
                    <option value=""></option>
                    @foreach($provinsis as $provinsi)
                        <option value="{{ $provinsi->id }}" {{ request('provinsi') == $provinsi->id ? 'selected' : '' }}>{{ $provinsi->nama_provinsi }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="kabupaten">Pilih Kabupaten:</label>
                <select name="kabupaten" id="kabupaten">
                    <option value=""></option>
                    @foreach($kabupatens as $kabupaten)
                        <option value="{{ $kabupaten->id }}" {{ request('kabupaten') == $kabupaten->id ? 'selected' : '' }}>{{ $kabupaten->nama_kabupaten }}</option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit">Filter</button>
            <a href="{{ route('export', ['provinsi' => request('provinsi'), 'kabupaten' => request('kabupaten')]) }}" class="btn btn-primary">Export Excel</a>
        </form>
    </div>

    <div>
        <form action="{{ route('home') }}" method="GET">
            <div>
                <label for="search">Cari Nama atau NIK:</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}">
            </div>
            <button type="submit">Cari</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>Kabupaten</th>
                <th>Provinsi</th>
                <th>Timestamp</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tabel as $index => $data)
                <tr>
                    <td>{{ $index + 1 + ($tabel->currentPage() - 1) * $tabel->perPage() }}</td>
                    <td>{{ $data->Nama }}</td>
                    <td>{{ $data->NIK }}</td>
                    <td>{{ $data->Tanggal_Lahir }}</td>
                    <td>{{ $data->Alamat }}, {{ $data->kabupaten->nama_kabupaten }}, {{ $data->provinsi->nama_provinsi }}</td>
                    <td>{{ $data->Jenis_Kelamin }}</td>
                    <td>{{ $data->kabupaten->nama_kabupaten }}</td>
                    <td>{{ $data->provinsi->nama_provinsi }}</td>
                    <td>{{ $data->Timestamp }}</td>
                    <td>
                        <a href="{{ route('edit', $data->id) }}">Edit</a> |
                        <form action="{{ route('hapus', $data->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    
    <form action="{{ route('tambah') }}" method="GET">
        <button type="submit">Tambah Data</button>
    </form>

    {{ $tabel->appends(['provinsi' => request('provinsi'), 'kabupaten' => request('kabupaten'), 'search' => request('search')])->links() }}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#provinsi').change(function() {
                var provinsiId = $(this).val();
                if (provinsiId) {
                    $.ajax({
                        type: "GET",
                        url: "/getKabupaten/" + provinsiId,
                        success: function(data) {
                            $('#kabupaten').empty();
                            $('#kabupaten').append('<option value="">Semua Kabupaten</option>');
                            $.each(data, function(key, value) {
                                $('#kabupaten').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#kabupaten').empty();
                    $('#kabupaten').append('<option value="">Semua Kabupaten</option>');
                }
            });
        });
    </script>

@endsection
