@extends('layouts.app')
@section('content')
    <div class="row p-3">
        <h3>Data Mahasiswa</h3>

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
                        <th>Program Studi</th>
                        <th>No HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($mahasiswa as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->nim }}</td>
                            <td>{{ $data->programStudi->nama }}</td>
                            <td>{{ $data->no_hp }}</td>
                            <td>
                                <a href="{{route('admin.resetPassword', ['id' => $data->user_id])}}" class="btn btn-primary">Reset Password</a>
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
                            <input type="text" id="nama" name="nama" value="{{ old('nama') }}" class="form-control" required><br>
                            @error('nama')
                                <span style="color: red;">{{ $message }}</span><br>
                            @enderror
                        </div>
                    
                        <div class="form-group mb-2">
                            <label for="nip">NIP</label><br>
                            <input type="text" id="nip" name="nip" value="{{ old('nip') }}" class="form-control" required><br>
                            @error('nip')
                                <span style="color: red;">{{ $message }}</span><br>
                            @enderror
                        </div>
                    
                        <div class="form-group mb-2">
                            <label for="jabatan">Jabatan</label><br>
                            <input type="text" id="jabatan" name="jabatan" value="{{ old('jabatan') }}" class="form-control" required><br>
                            @error('jabatan')
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
