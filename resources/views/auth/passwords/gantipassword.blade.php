@extends('auth.layouts.app')
@section('content')
<div class="login-logo">
    <a href="/gantipassword"><b>MDT</b>Sirojul Athfal</a>
</div>
  <!-- /.login-logo -->
<div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silakan untuk melakukan pergantian password.</p>
      @if (session()->has('success'))
        <div class="alert alert-info">
            {{ session()->get('success') }}
        </div>
      @endif

      <form action="/gantipassword" method="post">
        @csrf
        @method("patch")
        @error('old_password')
        <div class="mt-2 text-danger">
            {{ $message }}
        </div>
        @enderror
        <div class="input-group mb-3">
          <input type="password" name="old_password" class="form-control" placeholder="Password Lama">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('password')
          <div class="mt-2 text-danger">
              {{ $message }}
          </div>
        @enderror
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password Baru">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Konfirmasi Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-success btn-block">Ganti Password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
</div>
@endsection