<!-- /.modal -->
<div class="modal fade" id="modal-edit{{$dtkelas->id}}">
    <div class="modal-dialog modal-sm">
        <div class="modal-content"> 
            <div class="modal-body">
            <form action="{{route('kelas.update', $dtkelas->id) }}" method="POST" autocomplete="off">
            @method('patch')
            @csrf
                <div class="custom-file">
                    <label for="nama">Nama Kelas</label>
                    <input type="text" name="nama_kelas" value="{{$dtkelas->nama_kelas}}" onkeyup="this.value=this.value.toUpperCase()" class="form-control">
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="submit" class="btn bg-gradient-success btn-sm">Update</button>   
            </div> 
            </form>
        </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
<!-- /.modal -->
</div>