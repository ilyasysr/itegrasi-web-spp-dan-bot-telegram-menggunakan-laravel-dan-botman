@extends('admin.layouts.app',['tittle' =>'SPPMDT | Pesan'])
@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pesan</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- general form elements disabled -->
        <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Tulis Pesan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">  
                <div class="row">
                  <div class="col-sm-6">
                    <!-- textarea -->
                    <form action="{{ url('/pesan-kirim') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                        {{-- <label>Textarea</label> --}}
                        <input name="penerima" class="form-control mb-2" placeholder="Masukan Id telegram penerima">
                        <textarea name="pesan" class="form-control" rows="3" placeholder="Masukan pesan"></textarea>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fa fa-paper-plane"></i> Kirim</button>
                        </div>
                    </form>
                  </div>
                  <div class="col-sm-6">
                    <!-- textarea -->
                    <form action="{{ url('/kirim-foto') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Pilih Gambar</label>
                            </div>
                            <div>
                              <button type="submit" class="btn btn-primary btn-sm float-right mt-3"><i class="fa fa-paper-plane"></i> Kirim</button>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
                <div class="col-sm-12">
                  @isset($dtTelegram)
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Id Pengirim</th>
                          <th>text</th>
                        </tr>
                      </thead>
                   
                      @foreach ($dtTelegram as $dt) 
                      <tbody>
                       <tr>
                         {{-- @isset($dtTelegram->message) --}}
                          <td>{{$loop->iteration}}</td>
                          <td>{{$dt->message->from->id}}</td>
                          <td>{{$dt->message->text}}</td>
                         {{-- @endisset --}}
                       </tr>
                       @endforeach
                    
                      </tbody> 
                    </table>
                  @endisset
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->
@endsection