@extends('admin.layouts.app',['tittle' =>'SPPMDT | Pembayaran Bulanan'])
@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Tambah Tarif Pembayaran</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-4 col-xs-12">
              <div class="card card-success card-outline">
                <!-- /.header-card -->
                <div class="card-header">
                  <h3 class="card-title">Informasi Tagihan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body"> 
                    <table class="table table-striped">
                        <tbody>
                            
                            <tr>
                                <td>Jenis</td>
                                <td>: <b>{{  $data->spp->nama_jenis_bayar}}</b></td>
                            </tr>
                            <tr>
                                <td>NIS</td>
                                <td>: <b>{{  $data->siswa->nis}}</b></td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>: <b>{{  $data->siswa->nama}}</b></td>
                            </tr>
                            <tr>
                                <td>Tahun Ajaran</td>
                                <td>: <b>{{  $data->spp->thn_ajaran}}</b></td>
                            </tr>
                                <td>Total Bayar</td>
                                <td>: <b>Rp {{number_format($total,0,",",".") }}</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mb-2">
                  <a href="{{url()->previous()}}" class="btn btn-secondary btn-block">Kembali</a></td>
                </div>
              </div>
            </div>
            <div class="col-md-8 col-xs-12">
              <div class="card card-success card-outline">
                <!-- /.header-card -->
                <div class="card-header">
                  <h3 class="card-title">Pembayaran Tagihan Bulanan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                   
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>No</th>
                            <th>Bulan</th>
                            <th>Jatuh Tempo</th>
                            <th>Tanggal Bayar</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($databayar as $dtbayar)
                            <tr @if ($dtbayar->keterangan == 'LUNAS') class="text-success" @else class="text-danger" @endif>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$dtbayar->bulan}}</td>
                                <td>{{$dtbayar->jatuh_tempo}}</td>
                                <td>{{$dtbayar->tgl_bayar}}</td>
                                <td>Rp {{number_format($dtbayar->biaya,0,",",".") }}</td>
                                <td>{{$dtbayar->keterangan}}</td>
                                <td>
                                    @if ($dtbayar->no_bayar == "") 
                                    <form action="/pembayaran/{{$dtbayar->id}}/bayar" method="POST">
                                        @csrf
                                        @method('patch')
                                        <button type="submit" class="btn btn-success btn-sm">Bayar</button>
                                    </form>
                                    @else
                                  
                                    <a  href="#" data-id="{{$dtbayar->id}}" class="btn btn-danger btn-xs swal-confirm2"><i class="fa fa-times"></i> Batalkan
                                        <form action="/pembayaran/{{$dtbayar->id}}/batal" id="delete{{ $dtbayar->id}}" method="POST">
                                        @csrf
                                        @method('put')
                                        </form>
                                    </a>
                                
                                    <a href="/pembayaran/{{$dtbayar->id}}/print" class="btn btn-warning btn-xs" target="_blank"><i class="fa fa-print"></i> Cetak</a>
                                    {{-- <a href="/pembayaran/{{$dtbayar->id}}/chat" class="btn btn-info btn-xs" target="_blank"><i class="fa fa-paper-plane"></i></a> --}}
                                                                              
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
        </div>
    </section>
</div>
@endsection