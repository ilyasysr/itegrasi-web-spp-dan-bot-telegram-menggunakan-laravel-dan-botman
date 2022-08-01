<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Clockwork\Request\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.laporan');
    }
    public function cekdata(Request $request)
    {
        if (request('tglawal', 'tglakhir')) {

            $laporan = Pembayaran::with(['siswa', 'spp'])->whereBetween('tgl_bayar', [request('tglawal'), request('tglakhir')])->get();
            return view('admin.laporan.laporan', compact('laporan'));
        }
    }
}
