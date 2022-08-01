<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->role == 'Siswa') {

            $nis = auth()->user()->username;
            $siswa = Siswa::where('nis', '=', $nis)->first();

            return view('home', [
                'pembayaran' => $siswa->pembayaran()->selectRaw('siswa_id,spp_id')->distinct()
                    ->whereHas('spp', function ($query) {
                        $query->where('tipe', '=', 'BULANAN');
                    })->orderBy('created_at', 'DESC')->get(),

                'pembayaranbebas' => $siswa->pembayaran()->whereHas('spp', function ($q) {
                    $q->where('tipe', '=', 'BEBAS');
                })->where('keterangan', '=', 'Belum Bayar')->get(),

                'htransaksi' => $siswa->pembayaran()->with(['siswa', 'spp'])
                    ->where('keterangan', 'LUNAS')->orderBy('no_bayar', 'DESC')->get(),
            ], compact('siswa'));
        } else {
            return view('home');
        }
    }

    public function show($sppid, $siswaid)
    {
        $nis = auth()->user()->username;
        $siswa = Siswa::where('nis', '=', $nis)->first();
        $sisid = Crypt::decrypt($siswaid);
        $spid = Crypt::decrypt($sppid);


        return view('home', [
            'detailbayar' => Pembayaran::where('spp_id', $spid)->where('siswa_id', $sisid)->get(),
            'infobayar' => Pembayaran::where('spp_id', $spid)->where('siswa_id', $sisid)->first(),

            'pembayaranbebas' => $siswa->pembayaran()->whereHas('spp', function ($q) {
                $q->where('tipe', '=', 'BEBAS');
            })->where('keterangan', '=', 'Belum Bayar')->get(),

            'htransaksi' => $siswa->pembayaran()->with(['siswa', 'spp'])
                ->where('keterangan', 'LUNAS')->orderBy('no_bayar', 'DESC')->get(),
        ], compact('siswa'));
    }

    public function tentang()
    {
        return view('tentang');
    }
}
