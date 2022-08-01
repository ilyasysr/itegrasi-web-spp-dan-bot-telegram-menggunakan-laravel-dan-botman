 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-success navbar-dark border-bottom-0">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          
          <img src="{{asset('admin/dist/img/usercolor.jpg')}}" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline"><i class="fas fa-check-circle"></i> {{Auth::user()->username}}</span>
          
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-light">
            <img src="{{asset('admin/dist/img/usercolor.jpg')}}" class="img-circle elevation-2" alt="User Image">
            <p>
              {{Auth::user()->name}} <br>
              <a href="/gantipassword" class="badge badge-success "><i class="fas fa-key"></i> Ganti Password</a>
            </p>
          </li>
          <li class="user-footer bg-dark">
            
            <form method="POST" action="{{ route('logout') }}">
              @csrf
            <a type="submit" class="btn btn-flat bg-gradient-success float-right"  onclick="event.preventDefault(); this.closest('form').submit();"><i class="fas fa-sign-out-alt"></i> Sign out</a>
            </form>
          </li>
        </ul>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li> --}}
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-green elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link bg-success">
      <img src="{{asset('admin/dist/img/Logo mdt-brand.png')}}" alt="MDT Logo" class="brand-image">
      <span class="brand-text font-weight-light">MDT SIROJUL ATHFAL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="{{url('dashboard')}}" class="nav-link {{ request()->is('dashboard') ? ' active' : '' }}">
              <i class="nav-icon fa fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">MENU</li>
          @if(Auth::user()->role == 'Admin')
          <li class="nav-item menu-open">
            <a href="#" class="nav-link {{ request()->is('siswa')||request()->is('kenaikankelas')||request()->is('kelas') ? 'active' : '' }} ">
              <i class="nav-icon fas fa-cubes"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('siswa')}}" class="nav-link {{ request()->is('siswa') ? ' active' : '' }}">
                  <i class="nav-icon fa fa-users"></i>
                  <p>
                    Siswa
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('kelas')}}" class="nav-link {{ request()->is('kelas') ? ' active' : '' }}">
                  <i class="nav-icon fas fa-landmark"></i>
                  <p>
                    Kelas
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('kenaikankelas')}}" class="nav-link {{ request()->is('kenaikankelas') ? ' active' : '' }}">
                  <i class="nav-icon fas fa-external-link-square-alt"></i>
                  <p>
                    Kenaikan Kelas
                  </p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item ">
            <a href="{{url('spp')}}" class="nav-link {{ request()->is('spp') ? ' active' : '' }}">
              <i class="nav-icon fas fa-money-bill"></i>
              <p>
                Jenis Pembayaran
              </p>
            </a>
          </li>
          @endif

          <li class="nav-item ">
            <a href="{{url('/pembayaran')}}" class="nav-link {{ request()->is('pembayaran') ? ' active' : '' }}">
              <i class="nav-icon fas fa-handshake"></i>
              <p>
                Transaksi Pembayaran
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{url('laporan')}}" class="nav-link {{ request()->is('laporan') ? ' active' : '' }}">
              <i class="nav-icon fa fa-file-contract"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
          @if(Auth::user()->role == 'Admin')
          <li class="nav-item ">
            <a href="{{url('user')}}" class="nav-link {{ request()->is('user') ? ' active' : '' }}">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Pengguna
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{url('pesan')}}" class="nav-link {{ request()->is('pesan') ? ' active' : '' }} ">
              <i class="nav-icon fa fa-bullhorn"></i>
              <p>
                Pesan Telegram
              </p>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>