<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{

    public function index()
    {
        $kelas = Kelas::withCount('siswa')->get();
        return view('admin.kelas.kelas', compact('kelas'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:5',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama,
        ]);

        alert()->success('Behasil', 'Data ditambahkan.');
        return redirect()->back();
    }

    public function show(Kelas $kela)
    {
        $dtsiswa = $kela->siswa()->get();
        return view('admin.kelas.showkelas', compact('kela', 'dtsiswa'));
    }


    public function edit(Kelas $kela)
    {
        return view('admin.kelas.kelas', compact('kela'));
    }


    public function update(Kelas $kela)
    {
        $update = request()->validate([
            'nama_kelas' => 'required|min:5',
        ]);

        $kela->update($update);

        alert()->success('Behasil', 'Data diubah');
        return redirect('kelas');
    }


    public function destroy(Kelas $kela)
    {
        $i = $kela->siswa()->count();
        if ($i > 0) {
            alert()->warning('Maaf', 'Data tidak dapat dihapus.');
            return redirect()->back();
        } else {
            $kela->delete();
            alert()->success('Berhasil', 'Data kelas dihapus.');
            return redirect()->back();
        }
    }
}
