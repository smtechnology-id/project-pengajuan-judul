@extends('layouts.app')

@section('content')
    <div class="row p-3">
        @if (isset($pengajuan))
        <div class="row p-3">
            <h3>Data Bimbingan</h3>
    
            <div class="table-responsive">
                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#standard-modal">
                    Tambah Data
                </button>
                <a href="{{ route('cetakKartu', ['id' => Auth::user()->id]) }}" class="btn btn-outline-primary mb-2">Cetak Kartu Bimbingan</a>
               
                <br>
                <h5>Bimbingan Dengan {{$pengajuan->dosenSatu->nama}}</h5>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Materi Bimbingan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($bimbinganSatu as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->tanggal }}</td>
                                <td>{{ $data->materi }}</td>
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
                                                    <h4 class="modal-title" id="standard-modalLabel">Deete Bimbingan</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda Yakin Akan Menghapus Data ini ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <a href="{{ route('mahasiswa.deleteBimbingan', ['id' => $data->id]) }}" class="btn btn-danger">Delete</a>
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
                                                    <form action="{{ route('mahasiswa.updateBimbingan') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                        <input type="hidden" name="pengajuan_id" value="{{ $pengajuan->id }}">
                                                    
                                                        <div class="form-group mb-2">
                                                            <label for="pembimbing">Dosen</label>
                                                            <select name="pembimbing" id="pembimbing" required class="form-control">
                                                                <option value="1">{{$pengajuan->dosenSatu->nama}}</option>
                                                                <option value="2">{{$pengajuan->dosenDua->nama}}</option>
                                                            </select>
                                                        </div>
                                                    
                                                        <div class="form-group mb-3">
                                                            <label for="tanggal">Tanggal</label>
                                                            <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ $data->tanggal }}" required>
                                                        </div>
                                                    
                                                        <div class="form-group mb-3">
                                                            <label for="materi">Materi</label>
                                                            <textarea id="materi" name="materi" class="form-control" required>{{ $data->materi }}</textarea>
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
                <br><br>
                <h5>Bimbingan Dengan {{$pengajuan->dosenDua->nama}}</h5>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Materi Bimbingan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($bimbinganDua as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->tanggal }}</td>
                                <td>{{ $data->materi }}</td>
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
                                                    <h4 class="modal-title" id="standard-modalLabel">Deete Bimbingan</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda Yakin Akan Menghapus Data ini ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <a href="{{ route('mahasiswa.deleteBimbingan', ['id' => $data->id]) }}" class="btn btn-danger">Delete</a>
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
                                                    <form action="{{ route('mahasiswa.updateBimbingan') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                        <input type="hidden" name="pengajuan_id" value="{{ $pengajuan->id }}">
                                                    
                                                        <div class="form-group mb-2">
                                                            <label for="pembimbing">Dosen</label>
                                                            <select name="pembimbing" id="pembimbing" required class="form-control">
                                                                <option value="1">{{$pengajuan->dosenSatu->nama}}</option>
                                                                <option value="2">{{$pengajuan->dosenDua->nama}}</option>
                                                            </select>
                                                        </div>
                                                    
                                                        <div class="form-group mb-3">
                                                            <label for="tanggal">Tanggal</label>
                                                            <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ $data->tanggal }}" required>
                                                        </div>
                                                    
                                                        <div class="form-group mb-3">
                                                            <label for="materi">Materi</label>
                                                            <textarea id="materi" name="materi" class="form-control" required>{{ $data->materi }}</textarea>
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
                        <h4 class="modal-title" id="standard-modalLabel">Tambah Data Bimbingan</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('mahasiswa.addBimbingan') }}" method="POST">
                            @csrf
                            <input type="hidden" id="user_id" name="user_id" class="form-control" required value="{{Auth::user()->id}}"><br>
                            <input type="hidden" id="pengajuan_id" name="pengajuan_id" class="form-control" required value="{{$pengajuan->id}}"><br>
                            <div class="form-group mb-2">
                                <label for="pembimbing">Dosen</label>
                                <select name="pembimbing" id="pembimbing" required class="form-control">
                                    <option value="1">{{$pengajuan->dosenSatu->nama}}</option>
                                    <option value="2">{{$pengajuan->dosenDua->nama}}</option>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                            </div>
                
                            <div class="form-group mb-2">
                                <label for="materi">Materi</label>
                                <textarea id="materi" name="materi" class="form-control" required></textarea>
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

        @else
            <h3>Anda Belum mengajukan Judul</h3>
        @endif
    </div>

@endsection
