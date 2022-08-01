<div class="card-body">
        <div class="row">
          <div class="col-sm-6">
            <!-- text input -->
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" value="{{old('nama') ?? $siswa->nama}}" class="form-control" placeholder="Nama">
              @error('nama')
              <div class="mt-2 text-danger">
                  {{ $message }}
              </div>
              @enderror
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>NIS</label>
              <input type="text" name="nis" value="{{ $nis ?? $siswa->nis}}" class="form-control" readonly >
              @error('nis')
              <div class="mt-2 text-danger">
                  {{ $message }}
              </div>
              @enderror
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label>Tanggal Lahir</label>
              <input class="form-control" type="date" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="tgl_lahir" value="{{old('tgl_lahir') ?? $siswa->tgl_lahir}}" ></input>
              @error('tgl_lahir')
              <div class="mt-2 text-danger">
                  {{ $message }}
              </div>
              @enderror
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                        <input type="radio" name="jenis_kelamin" value="Laki-laki" {{($siswa->jenis_kelamin == "Laki-laki") ? "checked" : "" }} id="radioSuccess1">
                        <label for="radioSuccess1">Laki-laki
                        </label>
                    </div>
                    <div class="icheck-success d-inline">
                        <input type="radio" name="jenis_kelamin" value="Perempuan" {{ ($siswa->jenis_kelamin == "Perempuan") ? "checked" : "" }}  id="radioSuccess2">
                        <label for="radioSuccess2">Perempuan
                        </label>
                    </div>
                    @error('jenis_kelamin')
                    <div class="mt-2 text-danger">
                      {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                <label>Nama Wali</label>
                <input type="text" name="nama_wali" value="{{old('nama_wali') ?? $siswa->nama_wali}}" class="form-control" placeholder="Nama">
                @error('nama_wali')
                <div class="mt-2 text-danger">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            {{-- <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                <label for="kelas">Kelas</label>
                <select name="kelas" class="form-control" id="kelas" >
                  <option disabled selected>--Pilih Kelas--</option>
                  @foreach ($kelas as $dtkelas)
                  <option {{ $dtkelas->id == $siswa->kelas_id ? 'selected' : ''}} value="{{ $dtkelas->id }}">{{$dtkelas->nama_kelas}}</option>
                  @endforeach
                </select>
                @error('kelas')
                <div class="mt-2 text-danger">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div> --}}
            <div class="col-sm-6">
              <div class="form-group">
                <label>No HP</label>
                <input type="number" min="0" name="no_hp" value="{{old('no_hp') ?? $siswa->no_hp}}" class="form-control" placeholder="08XXXXXXXXXX">
                @error('no_hp')
                <div class="mt-2 text-danger">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Alamat</label>
                <textarea type="text" name="alamat" class="form-control" placeholder="Alamat">{{old('alamat') ?? $siswa->alamat}}</textarea>
                @error('alamat')
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
    <a href="/siswa" class="btn btn-secondary">Kembali</a>
    <button type="submit" class="btn btn-success float-right">{{ $submit ?? 'Update'}}</button>
</div>