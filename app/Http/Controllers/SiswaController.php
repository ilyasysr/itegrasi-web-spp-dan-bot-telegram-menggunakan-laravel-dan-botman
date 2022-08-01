<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Spp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::with('kelas')->get();
        return view('admin.dataSiswa.siswa', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $cek = Siswa::count();
        $tahun = date('Y');

        if ($cek == 0) {
            $nourut = '001';
            $nis = '17' . $tahun . $nourut;
        } else {
            $i = Siswa::orderBy('nis', 'desc')->limit(1)->first();
            $nourut = (int)substr($i->nis, -3) + 1;
            $nis = '17' . $tahun . sprintf("%03s", $nourut);
        }


        return view('admin.dataSiswa.tambahSiswa', [
            'siswa' => new Siswa(),
            'kelas' => Kelas::get(),
            'nis' => $nis
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            // 'kelas' => 'required',
            'nama_wali' => 'required',
            'no_hp' => 'required|min:11|max:13',
            'alamat' => 'required',
        ]);


        Siswa::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            // 'kelas_id' => $request->kelas,
            'nama_wali' => $request->nama_wali,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        User::create([
            'name' => $request->nama,
            'username' => $request->nis,
            'password' => bcrypt($request->nis),
            'role' => 'Siswa',
        ]);

        alert()->success('Sukses', 'Data berhasil disimpan.');
        return redirect()->back();
    }

    public function show(Siswa $siswa)
    {
        //
    }


    public function edit(Siswa $siswa)
    {
        return view('admin.dataSiswa.editSiswa', [
            'siswa' => $siswa,
            'kelas' => Kelas::get(),
        ]);
    }


    public function update(Request $request, Siswa $siswa)
    {

        request()->validate([
            'nama' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            // 'kelas' => 'required',
            'nama_wali' => 'required',
            'no_hp' => 'required|min:11|max:13',
            'alamat' => 'required',
        ]);
        $update = [
            'nis' => $request->nis,
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            // 'kelas_id' => $request->kelas,
            'nama_wali' => $request->nama_wali,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ];

        $user = User::where('username', '=', $siswa->nis);

        $siswa->update($update);
        $user->update([
            'name' => $request->nama
        ]);

        alert()->success('Behasil', 'Data berhasil diubah.');
        return redirect('siswa');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect('siswa');
    }
}
