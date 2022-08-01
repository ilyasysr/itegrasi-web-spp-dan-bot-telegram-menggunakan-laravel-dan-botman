@extends('admin.layouts.app',['tittle' =>'SPPMDT | Daftar Siswa'])
@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Siswa</h1>
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
                  <button type="submit" class="btn btn-blok bg-gradient-success btn-sm" data-toggle="modal" data-target="#modal-sm"><i class="fas fa-file-import"></i> Import</button>
                  <a href="/export" class="btn btn-blok bg-gradient-secondary btn-sm ml-1"><i class="fas fa-file-export"></i> Export</a>
                  <div class="card-tools">
                    <a href="{{ route('siswa.create') }}" class="btn btn-blok bg-gradient-primary btn-sm"><i class="fas fa-plus"></i> Tambah Siswa</a>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>Nama</th>
                      <th>Tgl Lahir</th>
                      <th>Jenis Kelamin</th>
                      <th>Kelas</th>
                      <th>Nama Wali</th>
                      <th>No HP</th>
                      <th>Alamat</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                    
                  <tbody>
                    @foreach ($siswa as $dtsiswa)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$dtsiswa->nis}}</td>
                      <td>{{$dtsiswa->nama}}</td>
                      <td>{{date('d-m-Y',strTotime($dtsiswa->tgl_lahir))}}</td>
                      <td>{{$dtsiswa->jenis_kelamin}}</td>
                      @if(!empty($dtsiswa->kelas->nama_kelas)) 
                      <td>{{$dtsiswa->kelas->nama_kelas}}</td>@else <td>{{"BELUM MEMILIKI KELAS"}}</td>
                      @endif
                      <td>{{$dtsiswa->nama_wali}}</td>
                      <td>{{$dtsiswa->no_hp}}</td>
                      <td>{{$dtsiswa->alamat}}</td>
                      <td>
                       
                          <a href="{{route('siswa.edit', $dtsiswa->id) }}" class="badge badge-success "><i class="fas fa-pencil-alt"></i></a>


                          <a href="#" data-id="{{$dtsiswa->id}}" class="badge badge-danger swal-confirm"><i class="fas fa-times"></i>
                            <form action="{{route('siswa.destroy', $dtsiswa->id) }}" id="delete{{ $dtsiswa->id}}" method="POST">
                              @csrf
                              @method('delete')
                            </form>
                          </a>

                          {{-- <form action="{{route('siswa.destroy', $dtsiswa->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <span><button class="btn btn-danger btn-xs" type="submit"><i class="fas fa-trash"></i></button></span>
                          </form> --}}
                        
                      </td>
                    </tr>
                    @endforeach
                  </tbody> 
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>Nama</th>
                      <th>Tgl Lahir</th>
                      <th>Jenis Kelamin</th>
                      <th>Kelas</th>
                      <th>Nama Wali</th>
                      <th>No HP</th>
                      <th>Alamat</th>
                      <th>Aksi</th>
                    </tr>
                  <tfoot>
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
      <form action="/import" method="POST" enctype="multipart/form-data">
        @csrf
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="file" id="exampleInputFile">
            <label class="custom-file-label" for="exampleInputFile">Pilih file EXEL</label>
          </div>
      </div>
      <div class="modal-footer justify-content-end">
        <button type="submit" class="btn bg-gradient-success btn-sm">Import</button>   
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection