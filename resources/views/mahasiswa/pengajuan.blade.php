@extends('layouts.app')

@section('content')
    <div class="row p-3">
        @if (isset($pengajuan))
            <div class="row">
                <div class="col-md-6">
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">{{ $pengajuan->judul }}</h5>
                            <p class="card-text">Deskripsi: {{ $pengajuan->deskripsi }}</p>
                            <table class="table table-borderless">
                                <tr>
                                    <td>Status Pengajuan</td>
                                    <td>:</td>
                                    <td>
                                        @if ($pengajuan->status == 'pending')
                                            <span class="text-warning">Pengajuan Sedang Ditinjau</span>
                                        @elseif($pengajuan->status == 'accepted')
                                            <span class="text-success">Pengajuan Telah Disetujui</span>
                                        @elseif($pengajuan->status == 'rejected')
                                            <span class="text-danger">Pengajuan Ditolak</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Catatan</td>
                                    <td>:</td>
                                    <td>
                                        @if ($pengajuan->status == 'pending')
                                            <span class="text-warning">{{ $pengajuan->catatan }}</span>
                                        @elseif($pengajuan->status == 'accepted')
                                            <span class="text-success">{{ $pengajuan->catatan }}</span>
                                        @elseif($pengajuan->status == 'rejected')
                                            <span class="text-danger">{{ $pengajuan->catatan }}</span>
                                        @endif
                                    </td>
                                </tr>

                            </table>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    Dosen Pembimbing 1
                                </div>
                                <div class="card-body">
                                    {{ $pengajuan->dosenSatu->nama }}
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    Dosen Pembimbing 1
                                </div>
                                <div class="card-body">
                                    {{ $pengajuan->dosenDua->nama }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <h3>Form Pengajuan Judul Skripsi</h3>
            <form action="{{ route('mahasiswa.pengajuanPost') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" required>
                </div>
                <div class="form-group mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="dosen_satu">Dosen Pembimbing 1</label>
                    <select class="form-control" id="dosen_satu" name="dosen_satu" required>
                        @foreach ($dosen as $row)
                            <option value="{{ $row->id }}">{{ $row->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="dosen_dua">Dosen Pembimbing 2</label>
                    <select class="form-control" id="dosen_dua" name="dosen_dua" required>
                        @foreach ($dosen as $row)
                            <option value="{{ $row->id }}">{{ $row->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Ajukan</button>
                </div>
            </form>
        @endif
    </div>
@endsection
