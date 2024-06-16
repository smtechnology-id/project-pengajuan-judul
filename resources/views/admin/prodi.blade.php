@extends('layouts.app')
@section('content')
    <div class="row p-3">
        <h3>Data Program Studi</h3>

        <div class="table-responsive">
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#standard-modal">
                Tambah Data
            </button>
            <br>
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Program Studi</th>
                        <th>Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($program_studis as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->jurusan }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#update{{ $data->id }}">
                                    Update
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#delete{{ $data->id }}">
                                    Delete
                                </button>
                                <div id="delete{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="standard-modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="standard-modalLabel">Update Dosen</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda Yakin Akan Menghapus Data ini ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a href="{{ route('admin.deleteProgramStudi', ['id' => $data->id]) }}"
                                                    class="btn btn-danger">Delete</a>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <div id="update{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="standard-modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="standard-modalLabel">Update Program Studi</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.updateProgramStudi') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                                    <div class="form-group mb-3">
                                                        <label for="nama">Nama Program Studi</label>
                                                        <input type="text" class="form-control" id="nama"
                                                            name="nama" value="{{ old('nama', $data->nama) }}"
                                                            required>
                                                        @error('nama')
                                                            <span style="color: red;">{{ $message }}</span><br>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="jurusan">Jurusan</label>
                                                        <input type="text" class="form-control" id="jurusan"
                                                            name="jurusan"
                                                            value="{{ old('jurusan', $data->jurusan) }}" required>
                                                        @error('jurusan')
                                                            <span style="color: red;">{{ $message }}</span><br>
                                                        @enderror
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
                    <h4 class="modal-title" id="standard-modalLabel">Tambah Program Studi</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.addProgramStudi') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nama">Nama Program Studi</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jurusan">Jurusan</label>
                            <input type="text" class="form-control" id="jurusan" name="jurusan" required>
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
