@extends('layouts.app')
@section('content')
    <div class="row p-3">
        <h3>Data Jadwal</h3>

        <div class="table-responsive">

            <br>
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($jadwal as $data)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $data->pengajuan->user->biodatamahasiswa->nama }}</td>
                            <td>{{ $data->pengajuan->user->biodatamahasiswa->nim }}</td>
                            <td> {{ \Carbon\Carbon::parse($data->waktu)->translatedFormat('l, j F Y H:i') }}
                            </td>
                            <td>
                                <a href="{{ route('detailJadwal', ['id' => $data->id]) }}"
                                    class="btn btn-primary btn-sm">Lihat Jadwal</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
