@extends('admin.layouts.app',['tittle' =>'SPPMDT | Siswa Baru'])
@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Siswa Baru</h4>
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
                <h4>Data Siswa Baru</h4>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="/siswabaru" method="post">
                    @csrf
                <div class="row">
                    <div class="col-4 col-xs-6">
                        <div class="form-group">
                            <label>Pilih Kelas</label>
                            <select name="kelas" class="form-control form-control-sm" id="kelas" required>
                                <option disabled selected hidden> --Pilih Kelas Tujuan-- </option>
                                @foreach ($kelas as $dtkelas)
                                <option value="{{ $dtkelas->id}}">{{$dtkelas->nama_kelas}}</option>
                                @endforeach
                            </select>
                            @error('kelas')
                            <div class="mt-2 text-danger">
                              {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table  class="table table-bordered" >
                            <thead >
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>
                                    <input type="checkbox"  id="checkall" > Pilih Semua
                                </th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            @foreach ($siswa as $dtsiswa)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$dtsiswa->nis}}</td>
                                <td>{{$dtsiswa->nama}}</td>
                                <td>{{$dtsiswa->jenis_kelamin}}</td>
                                <td>
                                    <input type="checkbox" class="checkitem" name="ids[]" value="{{$dtsiswa->id}}">
                                </td>
                            </tr>
                            @endforeach
                            </tbody> 
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success float-right">Simpan</button>
                </div>
                </form>

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