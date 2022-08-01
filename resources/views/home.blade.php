@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        @if (session()->has('success'))
        <div class="alert alert-info">
            {{ session()->get('success') }}
        </div>
        @endif
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0"> Assalamualaikum <small>{{Auth::user()->name}}</small></h1>
            @if(!Auth::user()->role == 'Admin' || !Auth::user()->role == 'TU')
            <h4 class="m-0"><small>Selamat datang di sistem informasi MDT Sirojul Athfal,<br>berikut kami sampaikan informasi perihal pembayaran dan tagihan.</small></h4>
            @endif

          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'TU')
        <div class="row">
            <a href="{{url('dashboard')}}" class="btn btn-success"> Masuk Dashboard </a>
        </div>
        @else
        <div class="row">
            @isset($siswa)
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-success card-outline">
                  <div class="card-body box-profile">
                    <div class="text-center">
                      <img class="profile-user-img img-fluid img-circle"
                           src="{{asset('admin/dist/img/usercolor.jpg')}}"
                           alt="User profile picture">
                    </div>
    
                    <h3 class="profile-username text-center">{{$siswa->nama}}</h3>
    
                    {{-- <p class="text-muted text-center">Siswa</p> --}}
    
                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>NIS</b> <b class="float-right">{{$siswa->nis}}</b>
                      </li>
                      <li class="list-group-item">
                        <b>Kelas</b> 
                        @if(!empty($siswa->kelas->nama_kelas))
                        <b class="float-right">{{$siswa->kelas->nama_kelas}}</b> 
                        @else
                        <b class="float-right">-</b> 
                        @endif 
                      </li>
                      <li class="list-group-item">
                        <b>Jenis Kelamin</b> <b class="float-right">{{$siswa->jenis_kelamin}}</b>
                      </li>
                    </ul>
                  </div>
                  <!-- /.card-body -->
                </div>
            </div>
            @endisset

            <div class="col-12 col-md-9 col-sm-12 col-xs-12">
                <div class="card card-success card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Tagihan Bulanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Tagihan Lainnya</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Riwayat Pembayaran</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Settings</a>
                    </li> --}}
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                        @isset($infobayar)
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 p-0">
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Nama Pembayaran</th>
                                        <th>: {{$infobayar->spp->nama_jenis_bayar}}</th>
                                    </tr>
                                    <tr>
                                        <th>Tahun Ajaran</th>
                                        <th>: {{$infobayar->spp->thn_ajaran}}</th>
                                    </tr>
                                </table>
                            </div>    
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <a href="{{url()->previous()}}" class="btn btn-secondary btn-sm float-right mb-2 mr-1">Kembali</a>
                            </div>
                        </div>    
                        @endisset
                        <div class="row table-responsive">
                            @isset($pembayaran)
                            <table class=" table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>          
                                    @foreach ($pembayaran as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->spp->thn_ajaran}}</td>
                                        <td>{{$data->spp->nama_jenis_bayar}}</td>
                                        <td class="text-center">
                                            <a href="/{{Crypt::encrypt($data->spp_id)}}/{{Crypt::encrypt($data->siswa_id)}}/show" class="btn btn-success btn-xs"><i class="far fa-eye"></i> Lihat Detail</a>
                                        </td>
                                    </tr>
                                    @endforeach         
                                </tbody>
                            </table>
                            @endisset
                            
                            @isset($detailbayar)
                            <table class="table table-bordered">
                                <thead> 
                                    <tr>
                                        <th>No</th>
                                        <th>Bulan</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Biaya</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detailbayar as $data)
                                    <tr @if ($data->keterangan == 'LUNAS') class="text-success" @else class="text-danger" @endif>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->bulan}}</td>
                                        <td>{{$data->jatuh_tempo}}</td>
                                        <td>Rp {{number_format($data->biaya,0,",",".")}}</td>
                                        <td>{{$data->keterangan}}</td>
                                        <td class="text-center">
                                            @if ($data->keterangan == "LUNAS") 
                                                <a href="/pembayaran/{{$data->id}}/print" class="btn btn-info btn-xs"><i class="fas fa-print"></i> Cetak</a>
                                            @else 
                                            @endif
                                        </td>    
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endisset

                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                        @isset($pembayaranbebas)
                        <div class="row table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Nama Pembayaran</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if ($pembayaranbebas->count() > 0)
                                @foreach ($pembayaranbebas as $data)
                                <tr class="text-danger"> 
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$data->spp->nama_jenis_bayar}}</td>
                                    <td>{{$data->spp->thn_ajaran}}</td>
                                    <td>Rp {{number_format($data->biaya,0,",",".")}}</td>
                                    <td>{{$data->keterangan}}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5" class="text-center">" Saat ini Anda tidak mempunyai tagihan "</td>
                                </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>  
                        @endisset
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                        <div class="row table-responsive">
                            @isset($htransaksi)
                            <table class=" table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Tgl Bayar</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <div style="display: none">
                                        {{$total = 0}}
                                    </div>
                                    @foreach ($htransaksi as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->spp->nama_jenis_bayar}} -T.A- {{$data->spp->thn_ajaran}}</td>
                                        <td>{{$data->tgl_bayar}}</td>
                                        <td>Rp {{number_format($data->biaya,0,",",".") }}</td>
                                        <div style="display: none">
                                            {{$total += $data->biaya}}
                                        </div>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="3" style="text-align: center">Total</th>
                                        <th>Rp {{number_format($total ,0,",",".")}}</th>
                                    </tr>
                                </tbody>
                            </table>
                            @endisset
                        </div>
                    </div>
                    {{-- <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                    </div> --}}
                    </div>
                </div>
                <!-- /.card -->
                </div>
            </div>
        </div>
        @endif
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
