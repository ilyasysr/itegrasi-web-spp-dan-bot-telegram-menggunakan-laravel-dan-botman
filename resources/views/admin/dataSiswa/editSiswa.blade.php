@extends('admin.layouts.app',['tittle' =>'SPPMDT | Edit Siswa'])
@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center">
          <!-- left column -->
          <div class="col-md-8 ">

            <div class="card card-success card-outline">
              <div class="card-header">
                <h3 class="card-title">Edit Siswa</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('siswa.update', $siswa->id)}}" method="POST" autocomplete="off">
                @csrf
                @method('patch')
                @include('admin.dataSiswa.form.form-control')
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