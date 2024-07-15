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
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->pengajuan->user->biodatamahasiswa->nama }}</td>
                            <td>{{ $data->pengajuan->user->biodatamahasiswa->nim }}</td>
                            <td> {{ \Carbon\Carbon::parse($data->waktu)->translatedFormat('l, j F Y H:i') }}
                            </td>
                            <td>
                                <a href="{{ route('detailJadwal', ['id' => $data->id]) }}"
                                    class="btn btn-primary btn-sm">Lihat Jadwal</a>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#updateJadwal{{ $data->id }}">
                                    Update Jadwal
                                </button>
                                <div id="updateJadwal{{$data->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="standard-modalLabel">Tambah Dosen</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.updateJadwal') }}" method="POST">
                                                    @csrf
                                                    <div class="form-group mb-3">
                                                        <label for="penguji_satu">Penguji 1</label>
                                                        <select class="form-control" id="penguji_satu" name="penguji_satu" required>
                                                            @foreach ($dosen as $row)
                                                                <option value="{{ $row->id }}">{{ $row->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" name="id" value="{{$data->id}}">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="penguji_satu">Penguji 2</label>
                                                        <select class="form-control" id="penguji_satu" name="penguji_satu" required>
                                                            @foreach ($dosen as $row)
                                                                <option value="{{ $row->id }}">{{ $row->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="penguji_satu">Penguji 3</label>
                                                        <select class="form-control" id="penguji_satu" name="penguji_satu" required>
                                                            @foreach ($dosen as $row)
                                                                <option value="{{ $row->id }}">{{ $row->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="waktu">Waktu</label>
                                                        <input type="datetime-local" class="form-control" id="waktu"
                                                            name="waktu" required value="{{$data->waktu}}">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="ruangan">Ruangan</label>
                                                        <input type="text" class="form-control" id="ruangan"
                                                            name="ruangan" required value="{{$data->ruangan}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                            
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>


    
@endsection
