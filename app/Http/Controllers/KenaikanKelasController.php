<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class KenaikanKelasController extends Controller
{
    public function index(Request $request)
    {
        if (request('kelas')) {

            $kelas = Kelas::all();
            $dtkelas = Kelas::where('id', 'like', '%' . $request->kelas)->first();
            $siswa = Siswa::where('kelas_id', 'like', '%' . $request->kelas)->get();
            // $siswa = $dtsiswa->with('kelas')->get();
            return view('admin.kenaikankelas.kenaikankelas', compact('kelas', 'siswa', 'dtkelas'));
        } else {
            $kelas = Kelas::all();
            return view('admin.kenaikankelas.kenaikankelas', compact('kelas'));
        }
    }
    public function show(Request $request)
    {
        // if (request('kelas')) {

        //     $kelas = Kelas::all();
        //     $dtsiswa = Siswa::where('kelas_id', 'like', '%' . $request->kelas)->first();

        //     $siswa = $dtsiswa->with('kelas')->get();

        //     return view('admin.transaksi.pembayaran', compact('kelas', 'siswa'));
        // } else {
        //     $kelas = Kelas::all();
        //     return view('admin.kenaikankelas.kenaikankelas', compact('kelas'));
        // }
    }
    public function update(Request $request)
    {
        $message = [
            'required' => 'Silahkan untuk dipilih kelasnya terlebih dahulu !'
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
