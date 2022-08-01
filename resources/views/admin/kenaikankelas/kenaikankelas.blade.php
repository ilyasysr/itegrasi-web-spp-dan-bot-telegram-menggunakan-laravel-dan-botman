@extends('admin.layouts.app',['tittle' =>'SPPMDT | Kenaikan Kelas'])
@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kenaikan Kelas</h1>
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
                <h3 class="card-title">Proses Pindah Kelas Dan Kenaikan Kelas</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form action="/kenaikankelas" method="GET" class="form-horizontal">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kelas Awal</label>
                    <div class="col-sm-3">
                        <select name="kelas" class="form-control form-control-sm" id="kelas">
                            <option disabled selected hidden> @if (request('kelas'))
                               {{$dtkelas->nama_kelas}}
                                @else --Pilih Kelas-- @endif 
                            </option>
                            @foreach ($kelas as $dtkelas)
                            <option value="{{ $dtkelas->id}}">{{$dtkelas->nama_kelas}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3 ">
                        <button type="submit" class="btn btn-success btn-sm ">Tampilkan</button>       
                    </div>
                    
                </div>
              </form>
                
              </div>  
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        @isset($siswa)
        <div class="row">
          <div class="col-12">
            <div class="card card-success card-outline">
              <div class="card-header">
                  <h3 class="card-title">Pilih Siswa Yang Akan Di Proses</h3>
              </div>
              <div class="card-body table-responsive">
                <form action="" method="post" class="form-horizontal">
                    @csrf
                    @method('patch')
                <table class="table table-bordered" >
                  <thead >
                    <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>Nama</th>
                      <th>Kelas</th>
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
                      <td>{{$dtsiswa->kelas->nama_kelas}}</td>
                      <td>
                            <input type="checkbox" class="checkitem" name="ids[]" value="{{$dtsiswa->id}}">
                      </td>
                    </tr>
                    @endforeach
                  </tbody> 
                </table>  
              </div>
              <div class="card-footer">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pindah/Naik Ke Kelas</label>
                        <div class="col-sm-3">
                            <select name="kelas" class="form-control form-control-sm" id="kelas" required>
                                <option disabled selected hidden>--Pilih Kelas--</option>
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
                        <div class="col-sm-3 ">
                            <button type="submit" formaction="/update" class="btn btn-success btn-sm ">Proses</button>       
                        </div>
                        
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div> 
        @endisset
      </div>
    </section>
      
    <!-- /.card -->
</div>
@endsection
