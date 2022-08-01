<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Spp;
use Illuminate\Http\Request;

class SppController extends Controller
{

    public function index()
    {
        $spp = Spp::orderBy('created_at', 'DESC')->get();
        return view('admin.spp.spp', compact('spp'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $create = $request->validate([
            'nama_jenis_bayar' => 'required|min:3',
            'thn_ajaran' => 'required|min:4',
            'tipe' => 'required',
        ]);

        Spp::create($create);
        alert()->success('Behasil', 'Data ditambahkan.');
        return redirect()->back();
    }


    public function show(Spp $spp)
    {
        return view('admin.spp.tambahbiayapembayaran', [
            'data' => $spp,
            'kelas' => Kelas::all()
        ]);
    }


    public function edit(Spp $spp)
    {
        //
    }


    public function update(Spp $spp)
    {
        $update = request()->validate([
            'nama_jenis_bayar' => 'required|min:3',
            'thn_ajaran' => 'required|min:5',
            'tipe' => 'required',
        ]);

        $spp->update($update);

        alert()->success('Behasil', 'Data diubah');
        return redirect('spp');
    }


    public function destroy(Spp $spp)
    {
        $i = $spp->pembayaran()->count();
        if ($i > 0) {
            alert()->warning('Maaf', 'Data tidak dapat dihapus.');
            return redirect()->back();
        } else {
            $spp->delete();
            alert()->success('Berhasil', 'Data kelas dihapus.');
            return redirect()->back();
        }
    }
}
