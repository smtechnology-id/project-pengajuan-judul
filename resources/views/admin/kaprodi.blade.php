@extends('layouts.app')
@section('content')
    <div class="row p-3">
        <h3>Data Kaprodi</h3>

        <div class="table-responsive">
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#standard-modal">
                Tambah Data
            </button>
            <br>
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Dosen</th>
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($kaprodi as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->user->name }}</td>
                            <td>{{ $data->nip }}</td>
                            <td>{{ $data->jabatan }}</td>
                            <td>{{ $data->user->email }}</td>
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
                                                <h4 class="modal-title" id="standard-modalLabel">Delete Kaprodi</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda Yakin Akan Menghapus Data ini ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a href="{{ route('admin.deleteKaprodi', ['id' => $data->id]) }}"
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
                                                <h4 class="modal-title" id="standard-modalLabel">Update Dosen</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.updateKaprodi') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" id="id" name="id"
                                                        value="{{ $data->id }}" class="form-control" required>

                                                    <div class="form-group mb-2">
                                                        <label for="nama">Nama</label><br>
                                                        <input type="text" id="nama" name="nama"
                                                            value="{{ old('nama', $data->nama) }}" class="form-control"
                                                            required><br>
                                                        @error('nama')
                                                            <span style="color: red;">{{ $message }}</span><br>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group mb-2">
                                                        <label for="nip">NIP</label><br>
                                                        <input type="text" id="nip" name="nip"
                                                            value="{{ old('nip', $data->nip) }}" class="form-control"
                                                            required><br>
                                                        @error('nip')
                                                            <span style="color: red;">{{ $message }}</span><br>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group mb-2">
                                                        <label for="jabatan">Jabatan</label><br>
                                                        <input type="text" id="jabatan" name="jabatan"
                                                            value="{{ old('jabatan', $data->jabatan) }}"
                                                            class="form-control" required><br>
                                                        @error('jabatan')
                                                            <span style="color: red;">{{ $message }}</span><br>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group mb-2">
                                                        <label for="program_studi">Program Studi</label><br>
                                                        <select id="program_studi" name="program_studi_id"
                                                            class="form-control" required>
                                                            @foreach ($program_studis as $program_studi)
                                                                <option value="{{ $program_studi->id }}"
                                                                    {{ $data->program_studi_id == $program_studi->id ? 'selected' : '' }}>
                                                                    {{ $program_studi->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group mb-2">
                                                        <label for="email">Email</label><br>
                                                        <input type="email" id="email" name="email"
                                                            value="{{ old('email', $data->user->email) }}"
                                                            class="form-control" required><br>
                                                        @error('email')
                                                            <span style="color: red;">{{ $message }}</span><br>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group mb-2">
                                                        <label for="password">Password</label><br>
                                                        <input type="password" id="password" name="password"
                                                            class="form-control"><br>
                                                        @error('password')
                                                            <span style="color: red;">{{ $message }}</span><br>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group mb-2">
                                                        <label for="password_confirmation">Repeat Password</label><br>
                                                        <input type="password" id="password_confirmation"
                                                            name="password_confirmation" class="form-control"><br>
                                                        @error('password_confirmation')
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
                    <h4 class="modal-title" id="standard-modalLabel">Tambah Kaprodi</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.addKaprodi') }}" method="POST">
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

                        <div class="form-group mb-2">
                            <label for="jabatan">Jabatan</label><br>
                            <input type="text" id="jabatan" name="jabatan" value="{{ old('jabatan') }}"
                                class="form-control" required><br>
                            @error('jabatan')
                                <span style="color: red;">{{ $message }}</span><br>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="program_studi">Program Studi</label><br>
                            <select id="program_studi" name="program_studi_id" class="form-control" required>
                                @foreach ($program_studis as $program_studi)
                                    <option value="{{ $program_studi->id }}">{{ $program_studi->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label for="email">Email</label><br>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="form-control" required><br>
                            @error('email')
                                <span style="color: red;">{{ $message }}</span><br>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="password">Password</label><br>
                            <input type="password" id="password" name="password" class="form-control" required><br>
                            @error('password')
                                <span style="color: red;">{{ $message }}</span><br>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="password">Repeat Password</label><br>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" required><br>
                            @error('password')
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
