<div class="modal fade" id="modal-edit{{$dtspp->id}}">
  <div class="modal-dialog modal-sm">
    <div class="modal-content"> 
      <div class="modal-body">
      <form action="{{route('spp.update', $dtspp->id)}}" method="POST" autocomplete="off">
        @method('patch')
        @csrf
          <div>
            <label for="nama">Nama Jenis Bayar</label>
            <input type="text" name="nama_jenis_bayar" onkeyup="this.value=this.value.toUpperCase()" value="{{$dtspp->nama_jenis_bayar}}" class="form-control" placeholder="Nama Jenis Bayar">
          </div>
          <div>
            <label for="nama">Tahun Ajaran</label>
            <input type="text" name="thn_ajaran" onkeyup="this.value=this.value.toUpperCase()" value="{{$dtspp->thn_ajaran}}" class="form-control" placeholder="Masukan Tahun">
          </div>
          <div>
            <label for="nama">Tipe</label>
            {{-- <input type="text" name="tipe" onkeyup="this.value=this.value.toUpperCase()" class="form-control" placeholder="Masukan Biaya"> --}}
            <select name="tipe" class="form-control">
              <option disabled selected>--Pilih Tipe--</option>
              <option {{ $dtspp->tipe == "BULANAN" ? 'selected' : ''}} value="BULANAN" >BULANAN</option>
              <option {{ $dtspp->tipe == "BEBAS" ? 'selected' : ''}} value="BEBAS" >BEBAS</option>
            </select>
          </div>
      </div>
      <div class="modal-footer justify-content-end">
        <button type="submit" class="btn bg-gradient-success btn-sm">Simpan</button>   
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>