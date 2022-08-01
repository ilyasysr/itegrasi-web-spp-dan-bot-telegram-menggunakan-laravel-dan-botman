<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaKelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        $siswa = Siswa::doesntHave('kelas')->get();
        return view('admin.kelas.siswabaru', compact('kelas', 'siswa'));
    }

    public function update(Request $request)
    {

        $message = [
            'required' => 'Silahkan untuk dipilih terlebih dahulu !'
        ];
        request()->validate([
            'kelas' => 'required',
            'ids' => 'required'
        ], $message);

        $ids = $request->get('ids');

        Siswa::whereIn('id', $ids)->update([
            'kelas_id' => $request->kelas,
        ]);

        alert()->success('Behasil', 'Proses data berhasil.');

        return redirect()->back();
    }
}
