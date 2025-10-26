<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('user8/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('user8/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Custom styles for this page -->
    <link href="{{asset('user8/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

</head>

<body id="page-top">
@include('sweetalert::alert')

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <!-- <div class="sidebar-brand-icon rotate-n-15">
                    
                </div> -->
                <div class="sidebar-brand-text mx-3">Prediksi Ikan<sup></sup></div>
            </a>

            <!-- Divider -->
            <!-- <hr class="sidebar-divider my-0"> -->

            <!-- Nav Item - Dashboard -->
            <li class="nav-item @yield('/')">
                <a class="nav-link" href="{{url('/')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            @if(Auth::user()->level == 'user')
            <li class="nav-item @yield('dataset')">
                <a class="nav-link" href="{{url('/dataset')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dataset</span></a>
            </li>
            <li class="nav-item @yield('prediksi')">
                <a class="nav-link" href="{{ url('prediksi') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Halaman Prediksi</span></a>
            </li>
            <li class="nav-item @yield('akurasi')">
                <a class="nav-link" href="{{ url('akurasi') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Halaman Evaluasi</span></a>
            </li>
            @else

            <!-- Divider -->
            

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item @yield('data')">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Kelola Data</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                       
                            <a class="collapse-item" href="{{url('/dataset')}}">Dataset</a>
                            <a class="collapse-item" href="{{url('/akun')}}">Data Akun</a>
                       
                       
                    </div>
                </div>
            </li>
            @endif
            <!-- Nav Item - Tables -->
             @if(Auth::user()->level == 'admin')
            <li class="nav-item @yield('prediksi')">
                <a class="nav-link" href="{{ url('prediksi') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Halaman Prediksi</span></a>
            </li>
            <li class="nav-item @yield('akurasi')">
                <a class="nav-link" href="{{ url('akurasi') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Halaman Evaluasi</span></a>
            </li>
            @else
            @endif
            <li class="nav-item @yield('logout')">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                    <span>LogOut</span></a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
         
        </ul>
        <!-- End of Sidebar -->