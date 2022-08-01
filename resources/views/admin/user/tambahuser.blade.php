@extends('admin.layouts.app',['tittle' =>'SPPMDT | Tambah Pengguna'])
@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Pengguna</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center">
          <!-- left column -->
          <div class="col-md-6 ">

            <div class="card card-success card-outline">
              <div class="card-header">
                <h3 class="card-title">Pengguna Baru</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('user.store')}}" method="POST" autocomplete="off">
                @csrf
                @include('admin.user.form.form-control',['submit' =>'Simpan'])
              </form>
            </div>
          <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->
@endsection