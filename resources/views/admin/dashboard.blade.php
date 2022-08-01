@extends('admin.layouts.app',['tittle' =>'SPPMDT | Dashboard'])
@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h5>Assalamulaikum {{Auth::user()->name}}, Selamat {{$salam}}</h5>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{$siswa}}</h3>
  
                  <p>Jumlah Siswa</p>
                </div>
                <div class="icon">
                  <i class="fas fa-users"></i>
                </div>
                <a href="{{url('siswa')}}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{$kelas}}</h3>
  
                  <p>Jumlah Kelas</p>
                </div>
                <div class="icon">
                  <i class="fas fa-landmark"></i>
                </div>
                <a href="{{url('kelas')}}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            {{-- <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{$pembayaran}}</h3>
  
                  <p>Jumlah Jenis Pembayaran</p>
                </div>
                <div class="icon">
                  <i class="fas fa-money-bill"></i>
                </div>
                <a href="{{url('spp')}}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div> --}}
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{$user}}</h3>
  
                  <p>Jumlah Pengguna</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user"></i>
                </div>
                <a href="{{url('user')}}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <h3>Rp {{number_format($day_in,0,",",".")}}</h3>
  
                  <p>Pemasukan Hari Ini</p>
                </div>
                <div class="icon">
                  <i class="fas fa-chart-bar"></i>
                </div>
                <a href="{{url('laporan')}}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <h3>Rp {{number_format($totaltagihan,0,",",".")}}</h3>
  
                  <p>Uang Tagihan</p>
                </div>
                <div class="icon">
                  <i class="fas fa-chart-bar"></i>
                </div>
                <a href="{{url('laporan')}}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3>Rp {{number_format($month_in,0,",",".")}}</h3>
  
                  <p>Pemasukan Bulan Ini</p>
                </div>
                <div class="icon">
                  <i class="fas fa-chart-bar"></i>
                </div>
                <a href="{{url('laporan')}}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>Rp {{number_format($year_in,0,",",".")}}</h3>
  
                  <p>Pemasukan Tahun Ini</p>
                </div>
                <div class="icon">
                  <i class="fas fa-chart-bar"></i>
                </div>
                <a href="{{url('laporan')}}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>Rp {{number_format($pendapatan,0,",",".")}}</h3>
  
                  <p>Seluruh Pemasukan</p>
                </div>
                <div class="icon">
                  <i class="fas fa-chart-bar"></i>
                </div>
                <a href="{{url('laporan')}}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->


            <!--Data History dan Tagihan -->
            <div class="col-md-6 col-xs-12">
              <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Histori Pembayaran</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>No</th>                               
                            <th>Nama</th>                     
                            <th>Jenis Pembayaran</th>
                            <th>Tanggal Bayar</th>
                            <th>Nominal Bayar</th>                     
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($history as $dthistory)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$dthistory->siswa->nama}}</td>        
                            <td>{{$dthistory->spp->nama_jenis_bayar}} - T.A {{$dthistory->spp->thn_ajaran}}</td>
                            <td>{{$dthistory->tgl_bayar}}</td>
                            <td>{{$dthistory->biaya}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xs-12">
              <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Tagihan Pembayaran</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example3"  class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th>No</th>                               
                            <th>Nama</th>                     
                            <th>Kelas</th>                     
                            <th>Jenis Tagihan</th>                     
                            <th>Jatuh Tempo</th>                     
                            {{-- <th>Tagihan Bulan</th>                                           --}}
                            {{-- <th>Keterangan</th>                           --}}
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($tagihan as $dttagihan)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$dttagihan->siswa->nama}}</td>        
                            <td>{{$dttagihan->siswa->kelas->nama_kelas}}</td>
                            <td>{{$dttagihan->spp->nama_jenis_bayar}}</td>
                            <td>{{$dttagihan->jatuh_tempo}}</td>
                            {{-- <td>{{$dttagihan->bulan}}</td> --}}
                            {{-- <td>{{$dttagihan->keterangan}}</td> --}}
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </section> 
</div>
@endsection
