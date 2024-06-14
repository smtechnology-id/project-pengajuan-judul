@extends('layouts.app')
@section('content')
    <div class="row p-3">
        <h3>Data Dosen</h3>

        <div class="table-responsive">
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#standard-modal">
                Tambah Data
            </button>
            <br>
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Detail</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($pengajuan as $data)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $data->user->biodatamahasiswa->nama }}</td>
                            <td>{{ $data->user->biodatamahasiswa->nim }}</td>
                            <td>{{ $data->judul }}</td>
                            <td>
                                @if ($data->status == 'pending')
                                    <span class="btn btn-outline-warning"> Sedang Di Tinjau</span>
                                @elseif ($data->status == 'rejected')
                                    <span class="btn btn-outline-danger"> Pengajuan Ditolak</span>
                                @elseif ($data->status == 'approved')
                                    <span class="btn btn-outline-success"> Pengajuan Disetujui</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-primary mb-2" data-bs-toggle="modal"
                                    data-bs-target="#detail{{ $data->id }}">
                                    Detail Pengajuan
                                </button>
                                <div id="detail{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="standard-modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="standard-modalLabel">Detail Pengajuan</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td>Nama</td>
                                                        <td>:</td>
                                                        <td>{{ $data->user->biodatamahasiswa->nama }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>NIM</td>
                                                        <td>:</td>
                                                        <td>{{ $data->user->biodatamahasiswa->nim }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jenis Kelamin</td>
                                                        <td>:</td>
                                                        <td>{{ $data->user->biodatamahasiswa->jenis_kelamin }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Prodi</td>
                                                        <td>:</td>
                                                        <td>{{ $data->user->biodatamahasiswa->program_studi }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jurusan</td>
                                                        <td>:</td>
                                                        <td>{{ $data->user->biodatamahasiswa->jurusan }}</td>
                                                    </tr>
                                                </table>
                                                <hr>
                                                <h5>Judul Skripsi</h5>
                                                <hr>
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td>Judul</td>
                                                        <td>{{ $data->judul }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Judul</td>
                                                        <td>{{ $data->deskripsi }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal Pengajuan</td>
                                                        <td>{{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('l, j F Y H:i') }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </td>
                            <td>
                                <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal"
                                    data-bs-target="#jadwal{{ $data->id }}">
                                    Buatkan Jadwal
                                </button>
                                <div id="jadwal{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="standard-modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="standard-modalLabel">Setujui Pengajuan</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.createJadwal') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="pengajuan_id" value="{{ $data->id }}">

                                                    <div class="form-group mb-3">
                                                        <label for="penguji_satu">Penguji 1</label>
                                                        <select class="form-control" id="penguji_satu" name="penguji_satu"
                                                            required>
                                                            @foreach ($dosen as $row)
                                                                <option value="{{ $row->id }}">{{ $row->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="penguji_dua">Penguji 2</label>
                                                        <select class="form-control" id="penguji_dua" name="penguji_dua"
                                                            required>
                                                            @foreach ($dosen as $row)
                                                                <option value="{{ $row->id }}">{{ $row->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="penguji_tiga">Penguji 3</label>
                                                        <select class="form-control" id="penguji_tiga" name="penguji_tiga"
                                                            required>
                                                            @foreach ($dosen as $row)
                                                                <option value="{{ $row->id }}">{{ $row->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="waktu">Waktu</label>
                                                        <input type="datetime-local" class="form-control" id="waktu"
                                                            name="waktu" required>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="ruangan">Ruangan</label>
                                                        <input type="text" class="form-control" id="ruangan"
                                                            name="ruangan" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
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
    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Tambah Dosen</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.addDosen') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="nama">Nama</label><br>
                            <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                                class="form-control" required><br>
                            @error('nama')
                                <span style="color: red;">{{ $message }}</span><br>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="nip">NIP</label><br>
                            <input type="text" id="nip" name="nip" value="{{ old('nip') }}"
                                class="form-control" required><br>
                            @error('nip')
                                <span style="color: red;">{{ $message }}</span><br>
                            @enderror
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
@endsection
