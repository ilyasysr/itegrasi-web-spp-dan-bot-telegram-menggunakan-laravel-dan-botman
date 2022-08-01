@extends('auth.layouts.app')
@section('content')
  <!-- /.login-logo -->
  <div class="card card-outline card-success">
    <div class="card-header text-center">
      <p href="" class="h4">SISTEM INFORMASI SPP</p>
      <img src="{{asset('admin/dist/img/Logo mdt.png')}}" width="50%" alt="User Image">
      <p href="" class="h4"><b>MDT SIROJUL ATHFAL</b></p>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Silahkan login</p>

      <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" @error('username') is-invalid @enderror" required  placeholder="Masukan Akun Pengguna">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" @error('password') is-invalid @enderror" class="form-control" required  placeholder="Masukan Kata Sandi">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="col-4 float-right">
        <button type="submit" class="btn btn-success btn-block">Masuk</button>
        </div>
        <div class="col-4">
            <img src="{{asset('admin/dist/img/slogan.png')}}" width="75%" alt="Slogan">
        </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection

