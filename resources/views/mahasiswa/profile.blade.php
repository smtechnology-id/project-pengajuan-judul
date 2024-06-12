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
                                                                {{ $biodata->program_studi }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">jurusan</th>
                                                        <td>
                                                            <a href="" class="ng-binding">
                                                                {{ $biodata->jurusan }}
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
                    <h5>Text in a modal</h5>
                    <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
                    <hr>
                    <h5>Overflowing text to show scroll behavior</h5>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p class="mb-0">Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel
                        scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor
                        fringilla.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
