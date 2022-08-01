@extends('admin.layouts.app',['tittle' =>'SPPMDT | Tahun Ajaran'])
@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Jenis Pembayaran</h1>
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
                {{-- <a href="/tambahkelas" class="btn btn-blok bg-gradient-primary btn-sm"><i class="fas fa-plus"></i> Tambah Siswa</a> --}}
                <button type="submit" class="btn btn-blok bg-gradient-primary btn-sm" data-toggle="modal" data-target="#modal-sm"><i class="fas fa-plus"></i> Tambah </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Pembayaran</th>
                      <th>Tahun Ajaran</th>
                      <th>Tipe</th>
                      <th>Biaya</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                    
                  <tbody>
                    @foreach ($spp as $dtspp)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$dtspp->nama_jenis_bayar}}</td>
                      <td>{{$dtspp->thn_ajaran}}</td>
                      <td>{{$dtspp->tipe}}</td>
                      <td>
                        <a href="{{route('spp.show',$dtspp->id)}}" class="badge badge-warning">Atur Tarif Pembayaran</a>
                      </td>
                      <td>
                        <a href="#" data-toggle="modal" data-target="#modal-edit{{$dtspp->id}}" class="badge badge-success "><i class="fas fa-pencil-alt"></i></a>
                        {{-- <a href="{{route('spp.edit', $dtspp->id) }}" class="badge badge-success"><i class="fas fa-pencil-alt"></i></a> --}}
                        
                        <a href="#" data-id="{{$dtspp->id}}" class="badge badge-danger swal-confirm3"><i class="fa fa-times"></i>  Hapus
                          <form action="{{route('spp.destroy', $dtspp->id) }}" id="delete{{ $dtspp->id}}" method="POST">
                            @csrf
                            @method('delete')
                          </form>
                        </a>
                      </td>
                    </tr>
                    @include('admin.spp.editspp')
                    @endforeach
                  </tbody> 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </section>
      
    <!-- /.card -->
</div>

 <!-- /.modal -->

<div class="modal fade" id="modal-sm">
  <div class="modal-dialog modal-sm">
    <div class="modal-content"> 
      <div class="modal-body">
      <form action="{{route('spp.store')}}" method="POST" autocomplete="off">
        @csrf
          <div>
            <label for="nama">Nama Jenis Bayar</label>
            <input type="text" name="nama_jenis_bayar" onkeyup="this.value=this.value.toUpperCase()" class="form-control" placeholder="Nama Jenis Bayar">
          </div>
          <div>
            <label for="nama">Tahun Ajaran</label>
            <input type="text" name="thn_ajaran" onkeyup="this.value=this.value.toUpperCase()" class="form-control" placeholder="Masukan Tahun">
          </div>
          <div>
            <label for="nama">Tipe</label>
            {{-- <input type="text" name="tipe" onkeyup="this.value=this.value.toUpperCase()" class="form-control" placeholder="Masukan Biaya"> --}}
            <select name="tipe" class="form-control">
              <option disabled selected>--Pilih Tipe--</option>
              <option value="BULANAN">BULANAN</option>
              <option value="BEBAS">BEBAS</option>
            </select>
          </div>
      </div>
      <div class="modal-footer justify-content-end">
        <button type="submit" class="btn bg-gradient-success btn-sm">Simpan</button>   
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection
