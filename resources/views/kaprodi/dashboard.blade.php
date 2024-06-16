@extends('layouts.app')
@section('content')
<div class="row">
    <div class="row">
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-purple">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-wallet-2-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Data Dosen</h6>
                    <h2 class="my-2">{{ $dosen }}</h2>
                </div>
            </div>
        </div> <!-- end col-->
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-warning">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-wallet-2-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Data Mahasiswa</h6>
                    <h2 class="my-2">{{ $mahasiswa }}</h2>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-pink">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-eye-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Data Pengajuan</h6>
                    <h2 class="my-2">{{ $pengajuan }}</h2>
                </div>
            </div>
        </div> <!-- end col-->
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-info">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-shopping-basket-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Data Jadwal</h6>
                    <h2 class="my-2">{{ $jadwal }}</h2>
                    
                </div>
            </div>
        </div> <!-- end col-->
    </div>
</div>
@endsection