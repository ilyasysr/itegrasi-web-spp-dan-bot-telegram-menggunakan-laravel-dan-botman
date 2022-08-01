@extends('admin.layouts.app',['tittle' =>'SPPMDT | Daftar Kelas'])
@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Kelas</h1>
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
                <div class="card-tools">
                  <a href="/siswabaru" class="btn btn-blok bg-gradient-secondary btn-sm"><i class="fas fa-user-plus"></i> Masukan Siswa Baru</a>
                </div>
                <button type="submit" class="btn btn-blok bg-gradient-primary btn-sm" data-toggle="modal" data-target="#modal-sm"><i class="fas fa-plus"></i> Tambah Kelas</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th hidden>ID Kelas</th>
                      <th>Nama</th>
                      <th>Jumlah Siswa</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                    
                  <tbody>
                    @foreach ($kelas as $dtkelas)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td hidden>{{$dtkelas->id}}</td>
                      <td>{{$dtkelas->nama_kelas}}</td>
                      <td>{{$dtkelas->siswa_count}}</td>
                      <td>
                        <a href="#" data-toggle="modal" data-target="#modal-edit{{$dtkelas->id}}" class="badge badge-success "><i class="fas fa-pencil-alt"></i></a>
                        <a href="#" data-id="{{$dtkelas->id}}" class="badge badge-danger badge-sm swal-confirm3"><i class="fa fa-times"></i>
                          <form action="{{route('kelas.destroy', $dtkelas->id) }}" id="delete{{ $dtkelas->id}}" method="POST">
                            @csrf
                            @method('delete')
                          </form>
                        </a>
                        <a href="{{route('kelas.show', $dtkelas->id) }}" class="badge badge-info "><i class="far fa-eye"></i> Lihat Anggota Kelas</a>

                      
                      </td>
                    </tr>
                    @include('admin.kelas.editkelas')
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
      <form action="{{route('kelas.store')}}" method="POST" autocomplete="off">
        @csrf
          <div class="custom-file">
            <label for="nama">Nama Kelas</label>
            <input type="text" name="nama" onkeyup="this.value=this.value.toUpperCase()" class="form-control" placeholder="Masukan Nama Kelas">
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
