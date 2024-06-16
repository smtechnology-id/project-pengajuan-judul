<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard Admin || Project Pengajuan Skripsi</title>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables@1.10.18/media/css/jquery.dataTables.min.css">

    <script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">


        <!-- ========== Topbar Start ========== -->
        <div class="navbar-custom">
            <div class="topbar container-fluid">
                <div class="d-flex align-items-center gap-1">

                    <!-- Topbar Brand Logo -->
                    <div class="logo-topbar">
                        <!-- Logo light -->
                        <a href="" class="logo-light">
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo">
                            </span>
                        </a>

                        <!-- Logo Dark -->
                        <a href="" class="logo-dark">
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="dark logo">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo">
                            </span>
                        </a>
                    </div>

                    <!-- Sidebar Menu Toggle Button -->
                    <button class="button-toggle-menu">
                        <i class="ri-menu-line"></i>
                    </button>

                    <!-- Horizontal Menu Toggle Button -->
                    <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </button>

                    <!-- Topbar Search Form -->
                    <div class="app-search d-none d-lg-block">

                    </div>
                </div>

                <ul class="topbar-menu d-flex align-items-center gap-3">




                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle arrow-none nav-user" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="account-user-avatar">
                                <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-image"
                                    width="32" class="rounded-circle">
                            </span>
                            <span class="d-lg-block d-none">
                                <h5 class="my-0 fw-normal">{{ Auth::user()->name }} <i
                                        class="ri-arrow-down-s-line d-none d-sm-inline-block align-middle"></i></h5>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                            <!-- item-->
                            @if (Auth::user()->role == 'mahasiswa')
                                <a href="{{ route('mahasiswa.profile') }}" class="dropdown-item">
                                    <i class="ri-logout-box-line fs-18 align-middle me-1"></i>
                                    <span>Profile</span>
                                </a>
                            @endif

                            <a href="{{ route('logout') }}" class="dropdown-item">
                                <i class="ri-logout-box-line fs-18 align-middle me-1"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ========== Topbar End ========== -->


        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">
            <!-- Brand Logo Light -->

            <!-- Sidebar -left -->
            <div class="h-100" id="leftside-menu-container" data-simplebar>
                <!--- Sidemenu -->
                <ul class="side-nav">

                    <li class="side-nav-title">
                        <h3>Tugas Akhir</h3>
                    </li>
                    @if (Auth::user()->role == 'admin')
                        <li class="side-nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                                <i class="ri-home-3-line"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.dosen') }}" class="side-nav-link">
                                <i class="ri-home-3-line"></i>
                                <span> Data Dosen </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.mahasiswa') }}" class="side-nav-link">
                                <i class="ri-home-3-line"></i>
                                <span> Data Mahasiswa </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.prodi') }}" class="side-nav-link">
                                <i class="ri-home-3-line"></i>
                                <span> Data Program Studi </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.kaprodi') }}" class="side-nav-link">
                                <i class="ri-home-3-line"></i>
                                <span> Data Kaprodi </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.pengajuan') }}" class="side-nav-link">
                                <i class="ri-home-3-line"></i>
                                <span> Data Pengajuan </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('admin.jadwal') }}" class="side-nav-link">
                                <i class="ri-home-3-line"></i>
                                <span> Data Jadwal </span>
                            </a>
                        </li>
                    @elseif (Auth::user()->role == 'kaprodi')
                        <li class="side-nav-item">
                            <a href="{{ route('kaprodi.dashboard') }}" class="side-nav-link">
                                <i class="ri-home-3-line"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('kaprodi.pengajuan') }}" class="side-nav-link">
                                <i class="ri-home-3-line"></i>
                                <span> Data Pengajuan </span>
                            </a>
                        </li>
                    @elseif (Auth::user()->role == 'mahasiswa')
                        <li class="side-nav-item">
                            <a href="{{ route('mahasiswa.dashboard') }}" class="side-nav-link">
                                <i class="ri-home-3-line"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('mahasiswa.pengajuan') }}" class="side-nav-link">
                                <i class="ri-home-3-line"></i>
                                <span> Pengajuan </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{ route('mahasiswa.bimbingan') }}" class="side-nav-link">
                                <i class="ri-home-3-line"></i>
                                <span> Bimbingan </span>
                            </a>
                        </li>
                    @endif




                </ul>
                <!--- End Sidemenu -->

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- ========== Left Sidebar End ========== -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container">
                    <div class="card">
                        <div class="card-body">
                            <p>Lampiran 4A : Form Berita Acara Seminar Proposal Skripsi</p>
                            <div class="row">
                                <div class="col-3 d-flex flex-column align-items-center justify-content-center"
                                    style="border: 1px solid #000;">
                                    <img src="{{ asset('assets/images/logo-politeknik.png') }}" alt="" style="width: 150px">
                                </div>
                                <div class="col-9  p-2 d-flex flex-column align-items-center justify-content-center"
                                    style="border: 1px solid #000; border-left: none">
                                    <h5>KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</h5>
                                    <h5>POLITEKNIK NEGERI SAMARINDA</h5>
                                    <p class="text-center">Jl. DR.Ciptomangunkusumo Kampus Gunung Lipan Samarinda 75131
                                        <br> Telp. 0541-260588, 260553, 262018 Fax. 0541-260355 <br>
                                        website: www.polnes.ac.id
                                    </p>
                                </div>
                                <div class="col-12 d-flex align-items-center justify-content-start"
                                    style="border: 1px solid #000; border-top: none">
                                    <p>FORMULIR 4A</p>
                                </div>
                                <div class="col-12 d-flex align-items-center justify-content-start"
                                    style="border: 1px solid #000; border-top: none">
                                    <p>BERITA ACARA SEMINAR PROPOSAL SKRIPSI</p>
                                </div>
                            </div>
                            <div class="row py-3">
                                <p>Pada hari ini {{ $biodata->nama }}. tangggal <td> {{ $jadwal->waktu->format('d') }}

                                        bulan {{ $jadwal->waktu->format('m') }} tahun
                                        {{ $jadwal->waktu->format('y') }}
                                        telah dilaksanakan Seminar Proposal Skripsi mahasiswa</p>
                                <br><br>
                                <p>Pelaksanaan seminar Proposal Skripsi dari mahasiswa :</p>
                                <table class="table table-borderless">
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td>{{ $biodata->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>NIM</td>
                                        <td>:</td>
                                        <td>{{ $biodata->nim }}</td>
                                    </tr>
                                    <tr>
                                        <td>HP / email</td>
                                        <td>:</td>
                                        <td>{{ $biodata->no_hp }} / {{ $user->email }}</td>
                                    </tr>

                                    <tr>
                                        <td>Program Studi / Jurusan</td>
                                        <td>:</td>
                                        <td>{{ $biodata->programStudi->nama }} / {{ $biodata->programStudi->jurusan }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Judul</td>
                                        <td>:</td>
                                        <td>{{ $pengajuan->judul }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pada Jam</td>
                                        <td>:</td>
                                        <td>{{ $jadwal->waktu->format('H:i') }} WITA</td>
                                    </tr>
                                </table>
                                <br><br>
                                <p>Setelah melihat, mendengar dan memperhatikan jalannya Seminar Proposal Skripsi, maka
                                    Tim Dosen Pembimbing dan Dosen Penguji memutuskan bahwa Proposal Skripsi mahasiswa
                                    tersebut dinyatakan :</p>
                                <p><b>Diterima / Tidak Diterima dengan perbaikan *</b>
                                </p>

                                <br><br>
                                <p class="text-center">
                                    <b>Tim Dosen Pembimbing</b>
                                </p>
                                <div class="row">
                                    <div class="col-6 d-flex align-items-center justify-content-center">
                                        <div class="text-center">
                                            <p>Tim Dosen Pembimbing I</p>
                                            <br><br><br>
                                            ({{$pengajuan->dosenSatu->nama}})
                                        </div>
                                    </div>
                                    <div class="col-6 d-flex align-items-center justify-content-center">
                                        <div class="text-center">
                                            <p>Tim Dosen Pembimbing II</p> <!-- assuming it's supposed to be 2 -->
                                            <br><br><br>
                                            ({{$pengajuan->dosenDua->nama}})
                                        </div>
                                    </div>
                                </div>
                                <p class="text-center mt-5">
                                    <b>Tim Dosen Penguji</b>
                                </p>
                                <div class="row">
                                    <div class="col-4 d-flex align-items-center justify-content-center">
                                        <div class="text-center">
                                            <p>Tim Dosen Penguji I</p>
                                            <br><br><br>
                                            ({{$jadwal->pengujiSatu->nama}})
                                        </div>
                                    </div>
                                    <div class="col-4 d-flex align-items-center justify-content-center">
                                        <div class="text-center">
                                            <p>Tim Dosen Penguji II</p> <!-- assuming it's supposed to be 2 -->
                                            <br><br><br>
                                            ({{$jadwal->pengujiDua->nama}})
                                        </div>
                                    </div>
                                    <div class="col-4 d-flex align-items-center justify-content-center">
                                        <div class="text-center">
                                            <p>Tim Dosen Penguji III</p> <!-- assuming it's supposed to be 2 -->
                                            <br><br><br>
                                            ({{$jadwal->pengujiTiga->nama}})
                                        </div>
                                    </div>
                                </div>
                                <p>
                                    Catatan
                                </p>
                                <ul>
                                    <li>Form ini setelah diisi dapat dikembalikan ke Koordinator</li>
                                    <li>Tanda *  coret salah satu.</li>
                                </ul>
                                
                            </div>
                            <div class="toolbar hidden-print">
                                <div class="text-end">
                                    <div class="d-print-none mt-4">
                                        <div class="text-center">
                                            <a href="javascript:window.print()" class="btn btn-primary"><i
                                                    class="ri-printer-line"></i> Print</a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> Developed With Love By SMTechnology.id</b>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->
    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/datatables@1.10.18/media/js/jquery.dataTables.min.js"></script>

    <script>
        $('table').dataTable();
    </script>
</body>

</html>
