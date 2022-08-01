@extends('admin.layouts.app',['tittle' =>'SPPMDT | Anggota Kelas'])
@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Data Anggota</h4>
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
                <h4>{{$kela->nama_kelas}}</h4>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>Nama</th>
                      <th>Jenis Kelamin</th>
                    </tr>
                  </thead>
                    
                  <tbody>
                    @foreach ($dtsiswa as $siswa)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$siswa->nis}}</td>
                      <td>{{$siswa->nama}}</td>
                      <td>{{$siswa->jenis_kelamin}}</td>
                    </tr>
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

@endsection