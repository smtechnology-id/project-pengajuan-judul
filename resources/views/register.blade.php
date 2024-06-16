<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>register Page || Project Pengajuan Skripsi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Website Pengajuan Judul Skripsi" name="description" />
    <meta content="Smtehcbology.id" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg position-relative">
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-8 col-lg-10">
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-12">
                                <div class="d-flex flex-column h-100">

                                    <div class="p-4 my-auto">
                                        <h4 class="fs-20">Sign In</h4>
                                        <p class="text-muted mb-3">Enter your email address and password to access
                                            account.
                                        </p>
                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif

                                        <!-- form -->
                                        <form method="POST" action="{{ route('registerPost') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <!-- NIM -->
                                                    <div class="mb-3">
                                                        <label for="nim" class="form-label">NIM</label>
                                                        <input id="nim" type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" required>
                                                        @error('nim')
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>

                                                    <!-- Nama -->
                                                    <div class="mb-3">
                                                        <label for="nama" class="form-label">Nama</label>
                                                        <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required>
                                                        @error('nama')
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>

                                                    <!-- Jenis Kelamin -->
                                                    <div class="mb-3">
                                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                                        <select id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" required>
                                                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                                            <option value="Laki-laki">Laki-laki</option>
                                                            <option value="Perempuan">Perempuan</option>
                                                        </select>
                                                        @error('jenis_kelamin')
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>

                                                    <!-- No HP -->
                                                    <div class="mb-3">
                                                        <label for="no_hp" class="form-label">No HP</label>
                                                        <input id="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp') }}" required>
                                                        @error('no_hp')
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
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

                                                    <!-- Jurusan -->
                                                </div>
                                                <div class="col-md-6">

                                                    <!-- Email -->
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email Address</label>
                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>

                                                    <!-- Password -->
                                                    <div class="mb-3">
                                                        <label for="password" class="form-label">Password</label>
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                        @enderror
                                                    </div>

                                                    <!-- Confirm Password -->
                                                    <div class="mb-3">
                                                        <label for="password-confirm" class="form-label">Confirm Password</label>
                                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                                    </div>

                                                    <div class="mb-0">
                                                        <button type="submit" class="btn btn-primary">Register</button>
                                                        <a href="{{route('index')}}" class="btn btn-outline-primary">Login</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- end form-->
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>

            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

</body>

</html>
