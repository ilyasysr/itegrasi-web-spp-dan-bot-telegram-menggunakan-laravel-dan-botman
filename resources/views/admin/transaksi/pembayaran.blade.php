@extends('admin.layouts.app',['tittle' =>'SPPMDT | Pembayaran'])
@section('content')
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Transaksi Pembayaran</h1>
                </div>
              </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="container-fluid">
            <h5 class="text-center display-5">Cari Siswa</h5>
            <div class="row mb-5">
                <div class="col-md-8 offset-md-2">
                    <form action="/pembayaran" method="GET">
                        <div class="form-group d-flex">
                            <select type="search" name="keyword" class="form-control select2bs4"  data-placeholder="{{request('keyword') ?? 'Nis | Nama Siswa' }} " style="width: 100%;">
                                <option disable></option> 
                                @foreach ($dtsiswa as $opsiswa)
                                <option>{{$opsiswa->nis}} | {{$opsiswa->nama}} </option>                                    
                                @endforeach
                            </select>
                            {{-- <input type="search" class="form-control" name="keyword"> --}}
                            <button type="submit" class="btn btn-default ml-1">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @isset($siswa)
            <div class="row">
                <div class="col-12">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Infomasi Siswa</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                </tr>
                                </thead>
                           
                                <tbody>
                                <tr>
                                    <td>NIS</td>
                                    <td>:</td>
                                    <td><b>{{$siswa->nis}}</b></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td><b>{{$siswa->nama}}</b></td>
                                </tr>
                                <tr>
                                    <td>Kelas</td>
                                    <td>:</td>
                                    @isset($siswa->kelas->nama_kelas)<td><b>{{$siswa->kelas->nama_kelas}}</b></td>@endisset
                                </tr>
                                
                                </tbody>
                           
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endisset

            {{-- ========================================Pembayaran Bebas--}}
            @isset($pembayaranbebas)
            <div class="row">
                <div class="col-12">
                  <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Pembayaran Bebas</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                              <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Nama Pembayaran</th>
                                    <th>Jatuh Tempo</th>
                                    <th>No Bayar</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($pembayaranbebas as $data)
                                <tr @if ($data->keterangan == 'LUNAS') class="text-success" @else class="text-danger" @endif > 
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$data->spp->thn_ajaran}}</td>
                                    <td>{{$data->spp->nama_jenis_bayar}}</td>
                                    <td>{{$data->jatuh_tempo}}</td>
                                    <td>{{$data->no_bayar}}</td>
                                    <td>{{$data->tgl_bayar}}</td>
                                    <td>Rp {{number_format($data->biaya,0,",",".") }}</td>
                                    <td>{{$data->keterangan}}</td>
                                    <td>
                                        @if ($data->no_bayar == "") 
                                        <form action="/pembayaran/{{$data->id}}/bayar" method="POST">
                                            @csrf
                                            @method('patch')
                                            <button type="submit" class="btn btn-success btn-sm">Bayar</button>
                                        </form>
                                        @else
                                      
                                        <a  href="#" data-id="{{$data->id}}" class="btn btn-danger btn-xs swal-confirm2"><i class="fa fa-times"></i> Batalkan
                                            <form action="/pembayaran/{{$data->id}}/batal" id="delete{{ $data->id}}" method="POST">
                                            @csrf
                                            @method('put')
                                            </form>
                                        </a>
                                    
                                        <a href="/pembayaran/{{$data->id}}/print" class="btn btn-warning btn-xs" target="_blank"><i class="fa fa-print"></i> Cetak</a>
                                        {{-- <a href="/pembayaran/{{$data->id}}/chat" class="btn btn-info btn-xs" target="_blank"><i class="fa fa-paper-plane"></i></a> --}}
                                                                                  
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                  </div>
                </div>
            </div>
            @endisset


            {{-- ========================================DATA Pembayaran--}}
              
            <div class="row">
                @isset($pembayaran)
                <div class="col-md-6 col-xs-12">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Pembayaran Bulanan</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
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
                                        <td>
                                            <a href="/pembayaran/{{$data->spp_id}}/{{$data->siswa_id}}/bulanan" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Bayar</a>
                                        </td>
                                    </tr>
                                    @endforeach
                               
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
                @endisset


                @isset($htransaksi) 
                <div class="col-md-6 col-xs-12">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Pembayaran</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
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

                        </div>

                    </div>
                </div>
                @endisset
            </div>
            
        </div>
    </section>
</div>
@endsection