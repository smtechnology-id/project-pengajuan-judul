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
                    <h6 class="text-uppercase mt-0" title="Customers">PengajuanJudul Disetujui</h6>
                    <h2 class="my-2">
                        @if ($pengajuan)
                            <span>1</span>
                            @else
                            <span>0</span>
                        @endif
                    </h2>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-pink">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-eye-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Jumlah Bimbingan</h6>
                    <h2 class="my-2">{{$bimbingan}}</h2>
                </div>
            </div>
    </div>
</div>
@endsection