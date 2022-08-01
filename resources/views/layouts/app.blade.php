<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{$tittle ?? 'Sistem Informasi MDT Sirojul Athfal'}}</title>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
    <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-dark navbar-success">
    <div class="container">
      <a href="{{url('/')}}" class="navbar-brand">
        <img src="{{asset('admin/dist/img/Logo mdt-brand.png')}}" alt="MDT Logo" class="brand-image " >
        <span class="brand-text font-weight-light"><strong>MDT Sirojul Athfal</strong></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="{{url('/')}}" {{ request()->is('/') ? ' active' : '' }} class="nav-link">Beranda</a>
          </li>
          <li class="nav-item">
            <a href="{{url('tentang')}}" {{ request()->is('tentang') ? ' active' : '' }} class="nav-link">Tentang</a>
          </li>
        </ul>

      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">{{Auth::user()->name}}</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{url('gantipassword')}}" class="dropdown-item">Ganti Password</a></li>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
              <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="dropdown-item">Logout</a></li>
              </form>
            </ul>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->
  @yield('content')
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      V.1.1.0
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021 <a href="/home">MDT Sirojul Athfal</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{asset('admin/dist/js/demo.js')}}"></script> --}}

<script>
  $("document").ready(function(){
  //   setTimeout(function(){
  // $("div.alert").remove();      
  //   }, 2000);

  // $(".alert").fadeTo(2000, 500).slideUp(500, function(){
  //   $(".alert").slideUp(500);
  // });
    $(".alert").fadeOut(5000);
  });
</script>
</body>
</html>