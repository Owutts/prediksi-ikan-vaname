@extends('template.appuser')
@section('title', 'Dashboard')
@section('/', 'active')
@section('content')
<div class="row">
<div class="col-xl-4 col-md-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Jumlah Data</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$dataset}}</div>
                </div>
                <div class="col-auto">
                    <i class="fab fa-product-hunt fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-4 col-md-4 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                      Jumlah User  </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$user}}</div>
                </div>
                <div class="col-auto">
                <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-4 col-md-4 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Akurasi Sistem (MAPE)
                    </div>

                    {{-- tampilkan nilai --}}
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $akurasi }}
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection