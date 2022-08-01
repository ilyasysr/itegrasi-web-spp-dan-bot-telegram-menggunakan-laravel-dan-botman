<div class="card-body">
    <div class="row">
      <div class="col-sm-12">
        <!-- text input -->
        <div class="form-group">
          <label>Nama</label>
          <input type="text" name="name" value="{{old('name') ?? $user->name}}" class="form-control" placeholder="Nama">
          @error('name')
          <div class="mt-2 text-danger">
              {{ $message }}
          </div>
          @enderror
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" value="{{ old('username') ?? $user->username}}" class="form-control" placeholder="Username" >
              @error('username')
              <div class="mt-2 text-danger">
                  {{ $message }}
              </div>
              @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
              <label>Password</label>
              <input type="text" name="password" class="form-control" placeholder="Default Password '12345678' jika tidak diisi">
              @error('password')
              <div class="mt-2 text-danger">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
          <!-- text input -->
          <div class="form-group">
            <label for="status">Status</label>
            <select name="role" class="form-control" id="status" >
              <option disabled selected>--Pilih status--</option>
              
              <option {{ $user->role == 'Admin' ? 'selected' : ''}} value="Admin" >Admin</option>
              <option {{ $user->role == 'TU' ? 'selected' : ''}}  value="TU" >TU</option>
              <option {{ $user->role == 'Siswa' ? 'selected' : ''}} value="Siswa" >Siswa</option>
             
            </select>
            @error('role')
            <div class="mt-2 text-danger">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
    </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
<a href="{{route('user.index')}}" class="btn btn-secondary">Kembali</a>
<button type="submit" class="btn btn-success float-right">{{ $submit ?? 'Update'}}</button>
</div>

<!-- /.register-box -->