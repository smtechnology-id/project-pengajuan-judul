@extends('layouts.app')

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="profile-bg-picture" style="background-image:url('assets/images/bg-profile.jpg')">
                        <span class="picture-bg-overlay"></span>
                        <!-- overlay -->
                    </div>
                    <!-- meta -->
                    <div class="profile-user-box">
                        <div class="row">
                            <div class="col-sm-6">
                                {{-- <div class="profile-user-img"><img src="assets/images/users/avatar-1.jpg" alt=""
                                        class="avatar-lg rounded-circle"></div> --}}
                                <div class="">
                                    <h4 class="mt-4 fs-17 ellipsis">{{ $biodata->nama }}</h4>
                                    <p class="font-13"> Mahasiswa {{ $biodata->program_studi }} - {{ $biodata->jurusan }}
                                    </p>
                                    <p class="text-muted mb-0"><small>Universitas Negeri</small></p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex justify-content-end align-items-center gap-2">
                                    <button type="button" class="btn btn btn-soft-danger" data-bs-toggle="modal" data-bs-target="#standard-modal">  <i class="ri-settings-2-line align-text-bottom me-1 fs-16 lh-1"></i>Update Profile</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ meta -->
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="card p-0">
                        <div class="card-body p-0">
                            <div class="profile-content">
                                <ul class="nav nav-underline nav-justified gap-0">
                                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#aboutme" type="button" role="tab" aria-controls="home"
                                            aria-selected="true" href="#aboutme">Profile</a>
                                    </li>
                                </ul>

                                <div class="tab-content m-0 p-4">
                                    <div class="tab-pane active" id="aboutme" role="tabpanel" aria-labelledby="home-tab"
                                        tabindex="0">
                                        <div class="profile-desk">
                                            <h5 class="text-uppercase fs-17 text-dark">{{ $biodata->nama }}</h5>

                                            <h5 class="mt-4 fs-17 text-dark">Contact Information</h5>
                                            <table class="table table-condensed mb-0 border-top">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Program Studi</th>
                                                        <td>
                                                            <a href="" class="ng-binding">
                                                                {{ $biodata->programStudi->nama }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">jurusan</th>
                                                        <td>
                                                            <a href="" class="ng-binding">
                                                                {{ $biodata->programStudi->jurusan }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Jenis Kelamin</th>
                                                        <td>
                                                            <a href="" class="ng-binding">
                                                                {{ $biodata->jenis_kelamin }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Email</th>
                                                        <td>
                                                            <a href="" class="ng-binding">
                                                                {{ Auth::user()->email }}
                                                            </a>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">Phone</th>
                                                        <td class="ng-binding">{{ $biodata->no_hp }}</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div> <!-- end profile-desk -->
                                    </div> <!-- about-me -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

        </div>
        <!-- end row -->

    </div>


    <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Modal Heading</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('mahasiswa.updateMahasiswa') }}">
                        @csrf
                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- NIM -->
                                <div class="mb-3">
                                    <label for="nim" class="form-label">NIM</label>
                                    <input id="nim" type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim', Auth::user()->biodataMahasiswa->nim) }}" required>
                                    @error('nim')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                    
                                <!-- Nama -->
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', Auth::user()->biodataMahasiswa->nama) }}" required>
                                    @error('nama')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                    
                                <!-- Jenis Kelamin -->
                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" required>
                                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin', Auth::user()->biodataMahasiswa->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin', Auth::user()->biodataMahasiswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                    
                                <!-- No HP -->
                                <div class="mb-3">
                                    <label for="no_hp" class="form-label">No HP</label>
                                    <input id="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp', Auth::user()->biodataMahasiswa->no_hp) }}" required>
                                    @error('no_hp')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                    
                                <div class="form-group mb-2">
                                    <label for="program_studi">Program Studi</label>
                                    <select id="program_studi" name="program_studi_id" class="form-control" required>
                                        @foreach ($program_studis as $program_studi)
                                            <option value="{{ $program_studi->id }}" {{ old('program_studi_id', Auth::user()->biodataMahasiswa->program_studi_id) == $program_studi->id ? 'selected' : '' }}>{{ $program_studi->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                    
                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                    
                                <!-- Confirm Password -->
                                <div class="mb-3">
                                    <label for="password-confirm" class="form-label">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                </div>
                    
                                <div class="mb-0">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
