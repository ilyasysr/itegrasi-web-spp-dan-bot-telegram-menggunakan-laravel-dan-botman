<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $tittle ?? 'SPPMDT'}}</title>
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">

</head>
<body class="layout-top-nav" onload="window.print();">

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content">
    <div class="container">
      <div class="row">

        <div class="col-12 col-xs-12 mt-4">
          <h4>
            <small class="float-right">NO: {{$dtprint->no_bayar}}</small>
          </h4>
          <div class="row">
            <div class="col-md-3 col-xs-4">
              <div>
                <img src="{{asset('admin/dist/img/logo MDT.png')}}" width="120px">
              </div>
            </div>
            <div class="col-md-8 col-xs-12">
              <div>
                <h4 class="text-center">MADRASAH DINIYAH TAKMILIYAH
                  <br><b>SIROJUL ATHFAL</b>
                </h4>
                <p class="text-md-center">Jl.Raya Nagrak-Cibadak No.37 RT 003/ RW 006 Desa Nagrak Selatan Keacamatan Nagrak Kabupaten Sukabumi
                </p>
              </div>
            </div>
          </div>   
          <hr class="bg-dark"></hr> 
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <h5 class="text-center"><b>BUKTI PEMBAYARAN</b></h5>
          <div class="col-6 mb-3">
            <div class="table-responsive">
              <table cellpadding="5">
                <tr>
                  <th>NIS</th>
                  <td>:</td>
                  <td>{{$dtprint->siswa->nis}}</td>
                </tr>
                <tr>
                  <th>Nama</th>
                  <td>:</td>
                  <td>{{$dtprint->siswa->nama}}</td>
                </tr>
                <tr>
                  <th>Kelas</th>
                  <td>:</td>
                  <td>{{$dtprint->siswa->kelas->nama_kelas}}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
       
        <div class="col-12 table-responsive">
          <table class="table table-bordered ">
            <thead>
            <tr>
              <th>Jenis Pembayaran</th>
              @if(!empty($dtprint->bulan))<th>Bulan</th>@else @endif
              <th>Tahun Ajaran</th>           
              <th>Tanggal Bayar</th>
              <th>Nominal</th>
              <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>{{$dtprint->spp->nama_jenis_bayar}}</td>
              @if(!empty($dtprint->bulan))<td>{{$dtprint->bulan}}</td>@else @endif
              <td>{{$dtprint->spp->thn_ajaran}}</td>
              <td>{{$dtprint->tgl_bayar}}</td>
              <td>Rp {{number_format($dtprint->biaya,0,",",".")}}</td>
              <td>{{$dtprint->keterangan}}</td>        
            </tr>
            </tbody>
          </table>
          <div class="float-right mt-4">
            <p class="text-center">Sukabumi, {{date('d F Y')}}<br>Petugas,<br><br><br><b><u>{{$dtprint->user->name}}</u><b/></p>
          </div>
        </div>
        <!-- /.col -->
      </div>
    </div>
  </div>
</div>
</body>
</html>
