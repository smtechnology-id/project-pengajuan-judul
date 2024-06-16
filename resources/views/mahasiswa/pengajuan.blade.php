@extends('layouts.app')

@section('content')
    <div class="row p-3">
        @if (isset($pengajuan))
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-3">
                                <img src="{{ asset('assets/images/logo-politeknik.png') }}" class="img-fluid rounded-start"
                                    alt="...">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title">Pengajuan Judul Skripsi - {{ Auth::user()->name }} - NIM ({{ $pengajuan->user->biodataMahasiswa->nim }})</h5>
                                    <table class="table-borderless">
                                        <tr>
                                            <td>Judul Skripsi</td>
                                            <td>:</td>
                                            <td>{{ $pengajuan->judul }}</td>
                                        </tr>
                                        <tr>
                                            <td>Deskripsi Judul Skripsi</td>
                                            <td>:</td>
                                            <td>{{ $pengajuan->deskripsi }}</td>
                                        </tr>
                                        <tr>
                                            <td>Program Studi</td>
                                            <td>:</td>
                                            <td>{{ $pengajuan->programStudi->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jurusan</td>
                                            <td>:</td>
                                            <td>{{ $pengajuan->programStudi->jurusan }}</td>
                                        </tr>
                                    </table>
                                    <p class="card-text"><small class="text-muted">Tanggal Pengajuan
                                            {{ $pengajuan->updated_at }}</small></p>
                                </div> <!-- end card-body-->
                            </div> <!-- end col -->
                        </div> <!-- end row-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3>Dosen Pembimbing</h3>
                    <div class="row">
                        <div class="col-12">
                            <div class="card ">
                                <div class="card-header">
                                    Dosen Pembimbing 1
                                </div>
                                <div class="card-body">
                                    {{ $pengajuan->dosenSatu->nama }} - NIP ({{ $pengajuan->dosenSatu->nip }})
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    Dosen Pembimbing 1
                                </div>
                                <div class="card-body">
                                    {{ $pengajuan->dosenDua->nama }} - NIP ({{ $pengajuan->dosenDua->nip }})
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>Status Pengajuan</h3>
                    <div class="row">
                        @if ($pengajuan->status == 'pending')
                            @php
                                $bg = 'success';
                            @endphp
                        @elseif ($pengajuan->status == 'approved')
                            @php
                                $bg = 'primary';
                            @endphp
                        @elseif($pengajuan->status == 'rejected')
                            @php
                                $bg = 'danger';
                            @endphp
                        @endif
                        <div class="col-md-12">
                            <div class="card text-bg-{{ $bg }}">
                                <div class="card-body">
                                    <h5 class="card-title">Status Pengajuan Judul Skripsi - {{ Auth::user()->name }}</h5>
                                    <table class="table-borderless" style="color: #fff">
                                        <tr>
                                            <td>Status Pengajuan</td>
                                            <td>:</td>
                                            <td>
                                                @if ($pengajuan->status == 'pending')
                                                    <span>Pengajuan Sedang Di Tinjau</span>
                                                @elseif ($pengajuan->status == 'approved')
                                                    <span>Pengajuan Telah Di Setujui Oleh Kaprodi</span>
                                                @elseif($pengajuan->status == 'rejected')
                                                    <span>Pengajuan Ditolak Oleh Kaprodi, Silahkan Update Data Pengajuan
                                                        Anda Sesuai Catatan Dibawah</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Catatan Dari Kaprodi</td>
                                            <td>:</td>
                                            <td>
                                                @if ($pengajuan->catatan)
                                                    {{ $pengajuan->catatan }}
                                                @else
                                                    <span> Belum Ada catatan</span>
                                                @endif

                                            </td>
                                        </tr>

                                    </table>
                                    <br>
                                    @if ($pengajuan->status == 'pending')
                                        <button type="button" class="btn btn-light mb-2" data-bs-toggle="modal"
                                            data-bs-target="#update">
                                            Update Data
                                        </button>
                                    @elseif ($pengajuan->status == 'approved')
                                    <a href="{{ route('detailJadwal', ['id' => $pengajuan->id]) }}"
                                        class="btn btn-light btn-sm">Lihat Jadwal</a>
                                    @elseif($pengajuan->status == 'rejected')
                                        <button type="button" class="btn btn-light mb-2" data-bs-toggle="modal"
                                            data-bs-target="#update">
                                            Update Data
                                        </button>
                                    @endif
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div>
                </div>
            </div>
            
    <div id="update" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Update Pengajuan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('mahasiswa.updatePengajuan') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" required
                            value="{{ old('judul', $pengajuan->judul) }}">
                        <input type="hidden" class="form-control" id="id" name="id" required
                            value="{{ old('id', $pengajuan->id) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi', $pengajuan->deskripsi) }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="dosen_satu">Dosen Pembimbing 1</label>
                        <select class="form-control" id="dosen_satu" name="dosen_satu" required>
                            @foreach ($dosen as $row)
                                <option value="{{ $row->id }}"
                                    {{ $pengajuan->dosen_satu == $row->id ? 'selected' : '' }}>{{ $row->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="dosen_dua">Dosen Pembimbing 2</label>
                        <select class="form-control" id="dosen_dua" name="dosen_dua" required>
                            @foreach ($dosen as $row)
                                <option value="{{ $row->id }}"
                                    {{ $pengajuan->dosen_dua == $row->id ? 'selected' : '' }}>{{ $row->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Ajukan</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
