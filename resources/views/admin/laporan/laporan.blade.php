@extends('admin.layouts.app',['tittle' =>'SPPMDT | Laporan'])
@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-success card-outline">
              <!-- /.header-card -->
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-filter"></i> Lihat Laporan Pembayaran</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Date -->
                <div class="row">
                  <div class="col-sm-3">
                    <label>Dari Tanggal:</label>
                  </div>
                  <div class="col-sm-3">
                    <label>Sampai Tanggal:</label>
                  </div>
                </div>
              <form action="/datalaporan" method="GET">
                <div class="row">
                  <div class="col-sm-3">
                    <input type="date" name="tglawal" id="tglawal" value="{{request('tglawal')}}" class="form-control form-control-sm"/>
                  </div>
                  <div class="col-sm-3">
                    <input type="date" name="tglakhir" id="tglakhir" value="{{request('tglakhir')}}" class="form-control form-control-sm"/>                        
                  </div>
                  <div class="col-sm-3">
                      <button type="submit" class="btn btn-success btn-sm">Tampilkan</button>       
                  </div>
                </div>
              </form>
                
              </div>  
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        @isset($laporan)
        <div class="row">
          <div class="col-12">
            <div class="card card-success card-outline">
              <div class="card-header">
                  <h3 class="card-title">Histori Pembayaran</h3>
              </div>
                  <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                          <thead>
                              <tr>
                              <th>No</th>
                              <th>NIS</th>
                              <th>Nama</th>                     
                              <th>Nama Pembayaran</th>
                              <th>Tahun Ajaran</th>
                              <th>Tanggal Bayar</th>
                              <th>Nominal Bayar</th>
                              <th>Keterangan</th>                          
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($laporan as $dtlaporan)
                            <tr>
                              <td>{{$loop->iteration}}</td>
                              <td>{{$dtlaporan->siswa->nis}}</td>
                              <td>{{$dtlaporan->siswa->nama}}</td>        
                              <td>{{$dtlaporan->spp->nama_jenis_bayar}}</td>
                              <td>{{$dtlaporan->spp->thn_ajaran}}</td>
                              <td>{{$dtlaporan->tgl_bayar}}</td>
                              <td>Rp {{number_format($dtlaporan->biaya,0,",",".")}}</td>
                              <td>{{$dtlaporan->keterangan}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                      </table>
                  </div>
            </div>
          </div>
        </div> 
        @endisset
      </div>
    </section>
      
    <!-- /.card -->
</div>
@endsection
