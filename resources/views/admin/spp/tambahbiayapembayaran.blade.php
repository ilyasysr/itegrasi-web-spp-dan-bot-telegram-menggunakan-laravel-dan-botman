@extends('admin.layouts.app',['tittle' =>'SPPMDT | Tambah Tarif Pembayaran'])
@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
          <div class="col-md-6 col-xs-12">
            <div class="card card-success card-outline">
              <!-- /.header-card -->
              <div class="card-header">
                <h3 class="card-title">Informasi Pembayaran</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form action="/spp/set" method="post" class="form-horizontal">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Bayar</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control form-control-sm" name="nama_pembayaran" value="{{$data->nama_jenis_bayar}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tahun</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control form-control-sm" name="thn_ajaran" value="{{$data->thn_ajaran}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tipe Bayar</label>
                    <div class="col-sm-7">
                        <input class="form-control form-control-sm" type="text" name="tipe" value="{{$data->tipe}}" readonly>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xs-12">
            <div class="card card-success card-outline">
              <!-- /.header-card -->
              <div class="card-header">
                <h3 class="card-title">Tarif Tagihan Per Kelas</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                    <div class="form-group row">
                        <input type="text" name="jenisbayar" value="{{$data->id}}" hidden>
                        <label class="col-sm-3 col-form-label">Pilih Kelas</label>
                        <div class="col-sm-7">
                            <select class="form-control form-control-sm" name="kelas" id="kelas">
                                <option disabled selected>--pilih kelas--</option>
                                @foreach ($kelas as $dtkelas)
                                <option value="{{$dtkelas->id}}">{{$dtkelas->nama_kelas}}</option>
                                @endforeach
                            </select>
                            @error('kelas')
                            <div class="mt-2 text-danger">
                              {{ $message }}
                            </div>
                            @enderror
                        </div> 
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tarif</label>
                        <div class="col-sm-7">
                            <input class="form-control form-control-sm" type="text" name="tarif" placeholder="Masukan Tarif">
                            @error('kelas')
                              <div class="mt-2 text-danger">
                                {{ $message }}
                              </div>
                            @enderror 
                        </div>   
                    </div>
              </div>
              <div class="card-footer">
                <a href="{{route('spp.index')}}" class="btn btn-secondary btn-sm">Kembali</a>
                <button class="btn btn-success btn-sm float-right">Simpan</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
@endsection