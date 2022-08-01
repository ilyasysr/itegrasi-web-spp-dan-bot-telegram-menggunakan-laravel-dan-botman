@extends('admin.layouts.app',['tittle' =>'SPPMDT | Pengguna'])
@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pengguna</h1>
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
                <a href="{{route('user.create')}}" class="btn btn-blok bg-gradient-primary btn-sm"><i class="fas fa-plus"></i> Daftarkan Pengguna Baru</a>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Username</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                    
                  <tbody>
                  @foreach ($users as $user)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->username }}</td>
                      <td>
                        @if($user->role == "Admin")
                        <p class="badge badge-success">{{ $user->role}}</p>
                        @elseif($user->role == "TU")
                        <p class="badge badge-info">{{ $user->role}}</p>
                        @elseif($user->role == "Siswa")
                        <p class="badge badge-warning">{{ $user->role}}</p>
                        @endif
                      
                      </td>
                      <td>
                        <a href="{{route('user.edit', $user->id) }}" class="badge badge-success "><i class="fas fa-pencil-alt"></i></a>
                        <a href="#" data-id="{{ $user->id }}" class="badge badge-danger badge-sm swal-confirm3"><i class="fa fa-times"></i>
                          <form action="{{route('user.destroy', $user->id)}}" id="delete{{ $user->id }}" method="POST">
                            @csrf
                            @method('delete')
                          </form>
                        </a>

                        {{-- <a href="/gantipassword" class="badge badge-info "><i class="fas fa-key"></i> Ganti Password</a> --}}
                      
                      </td>
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

 <!-- /.modal -->
@endsection
