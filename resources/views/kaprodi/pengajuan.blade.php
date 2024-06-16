@extends('layouts.app')
@section('content')
    <div class="row p-3">
        <h3>Data Pengajuan Skripsi</h3>
        <div class="table-responsive">
            <br>
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Judul</th>
                        <th>Detail</th>
                        <th>Status</th>
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
                                                        <td>{{ $data->user->biodatamahasiswa->programStudi->nama }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jurusan</td>
                                                        <td>:</td>
                                                        <td>{{ $data->user->biodatamahasiswa->programStudi->jurusan }}</td>
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
                                @if ($data->status == 'pending')
                                    <span class="text-warning font-weight-bold" style="font-weight: bold; font-size: 16px">
                                        Sedang Di Tinjau</span>
                                @elseif ($data->status == 'rejected')
                                    <span class="text-danger font-weight-bold" style="font-weight: bold; font-size: 16px">
                                        Pengajuan Ditolak</span>
                                @elseif ($data->status == 'approved')
                                    <span class="text-success font-weight-bold" style="font-weight: bold; font-size: 16px">
                                        Pengajuan Disetujui</span>
                                @endif
                            </td>
                            <td>
                                @if ($data->status == 'approved')
                                    <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal"
                                        data-bs-target="#rejected{{ $data->id }}">
                                        Tolak
                                    </button>
                                @elseif ($data->status == 'rejected')
                                <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal"
                                    data-bs-target="#setujui{{ $data->id }}">
                                    Setujui
                                </button>
                                @elseif ($data->status == 'pending')
                                <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal"
                                    data-bs-target="#setujui{{ $data->id }}">
                                    Setujui
                                </button>
                                <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal"
                                    data-bs-target="#rejected{{ $data->id }}">
                                    Tolak
                                </button>
                                @endif
                                
                                
                                <div id="setujui{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="standard-modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="standard-modalLabel">Setujui Pengajuan</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('kaprodi.updateStatus') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="pengajuan_id" value="{{ $data->id }}">
                                                    <input type="hidden" name="status" value="approved">
                                                    <div class="form-group">
                                                        <label for="catatan">Catatan</label>
                                                        <textarea name="catatan" id="catatan" cols="30" rows="3" class="form-control"></textarea>
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
                                <div id="rejected{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="standard-modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="standard-modalLabel">Tolak Pengajuan</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('kaprodi.updateStatus') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="pengajuan_id"
                                                        value="{{ $data->id }}">
                                                    <input type="hidden" name="status" value="rejected">
                                                    <div class="form-group">
                                                        <label for="catatan">Catatan</label>
                                                        <textarea name="catatan" id="catatan" cols="30" rows="3" class="form-control"></textarea>
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
@endsection
