<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{

    public function index(Request $request)
    {
        if (request('keyword')) {

            $dtsiswa = Siswa::all();
            $siswa = Siswa::where('nis', 'like', '%' . substr($request->keyword, 0, 9) . '%')->first();
            //Data bulanan
            $pembayaran = $siswa->pembayaran()->selectRaw('siswa_id,spp_id')->distinct()
                ->whereHas('spp', function ($query) {
                    $query->where('tipe', '=', 'BULANAN');
                })->orderBy('created_at', 'DESC')->get();

            // $pembayaranbulanan = $siswa->pembayaran()->whereHas('spp', function ($q) {
            //     $q->where('tipe', '=', 'BULAN');
            // })->get();

            // $pembayaranbulanan = $siswa->pembayaran()->with(['spp' => function ($query) {
            //     $query->where('tipe', '=', 'BEBAS');
            // }])->get();
            // dd($pembayaranbulanan);

            //Data pembayaran bebas
            $pembayaranbebas = $siswa->pembayaran()->whereHas('spp', function ($q) {
                $q->where('tipe', '=', 'BEBAS');
            })->get();

            //Data Riwayat Pembayaran
            $htransaksi = $siswa->pembayaran()->with(['siswa', 'spp'])
                ->where('keterangan', 'LUNAS')->orderBy('no_bayar', 'DESC')->get();

            // $pembayaran = $siswa->pembayaran()->with('spp')->get();

            return view('admin.transaksi.pembayaran', compact('pembayaran', 'htransaksi', 'pembayaranbebas', 'dtsiswa', 'siswa'));
        } else {
            $dtsiswa = Siswa::all();
            return view('admin.transaksi.pembayaran', compact('dtsiswa'));
        }
    }

    public function batal($id)
    {
        $batal = Pembayaran::find($id);

        $update = [
            'no_bayar' => null,
            'tgl_bayar' => null,
            'keterangan' => 'DIBATALKAN',
        ];
        $batal->update($update);
        return redirect()->back();
    }

    public function store(Request $request)
    {
        //
    }

    public function print($id)
    {
        $dtprint = Pembayaran::find($id);
        return view('admin.transaksi.printtrans', compact('dtprint'));
    }

    public function show($sppid, $siswaid)
    {

        $data = Pembayaran::where('spp_id', $sppid)->where('siswa_id', $siswaid)->first();
        $databayar = Pembayaran::where('spp_id', $sppid)->where('siswa_id', $siswaid)->get();
        $total = Pembayaran::where('spp_id', $sppid)->where('siswa_id', $siswaid)->sum('biaya');

        //cara ke 2 hanya TIDAK BISA PRINT DAN BATALKAN
        // $siswa = Siswa::find($siswaid);
        // $databayar = $siswa->pembayaran()->where('spp_id', $sppid)
        //     ->where('keterangan', 'Belum Bayar')->get();
        // dd($databayar);

        return view('admin.transaksi.bayarbulanan', compact('data', 'databayar', 'total'));
    }

    public function update($id)
    {
        $bayar = Pembayaran::find($id);

        $tgl_bayar = Carbon::now()->format('Y-m-d');
        $tglbayar = Carbon::now();
        $thnbln = $tglbayar->year . $tglbayar->month;
        $cek = Pembayaran::count('no_bayar');

        if ($cek == 0) {
            $nourut = 1001;
            $nomor = 'SPP' . $thnbln . $nourut;
        } else {
            $ambil = Pembayaran::orderBy('no_bayar', 'desc')->limit(1)->first();
            $nourut = (int)substr($ambil->no_bayar, -4) + 1;
            $nomor = 'SPP' . $thnbln . $nourut;
        }
        $update = [
            'user_id' => auth()->user()->id,
            'no_bayar' => $nomor,
            'tgl_bayar' => $tgl_bayar,
            'keterangan' => 'LUNAS',
        ];
        $bayar->update($update);
        alert()->success('Berhasil', 'Dibayar.');
        return redirect()->back();
    }


    public function destroy($id)
    {
        //
    }
    // public function kirimchat($id)
    // {
    //     $dtbayar = Pembayaran::find($id);
    //     $no_hp = $dtbayar->siswa->no_hp;
    //     $name = $dtbayar->siswa->nama;
    //     $message = 'Assalamulaikum Selamat Siang Kami dari bagian Administrasi MDT Siroul Athfal menyampaikan perihal pembayaran SPP agar segera menyelesaikan pembayarannya.Terimakasih atas perhatiannya. Wassalamualaikum Wr.Wb';
    //     return redirect('https://api.whatsapp.com/send?phone=' . $no_hp . '&text=Nama:%20' . $name . '%20%0DPesan:%20' . $message . '');
    // }
}
