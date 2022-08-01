<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Spp;
use Illuminate\Http\Request;

class SetbiayaController extends Controller
{

    public function set(Request $request)
    {

        if ($request->tipe == "BULANAN") {
            $request->validate([
                'kelas' => 'required',
                'tarif' => 'required',
            ]);

            $idnbulan = [
                '01' => 'Januari',
                '02' => 'February',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember',
            ];

            $awal_tempo = date('Y-m-d');

            // $idsiswa = Siswa::all('id');
            $idsiswa = Siswa::where('kelas_id', $request->kelas)->get();
            // $idspp = Spp::find($id)->first();

            foreach ($idsiswa as $id) {
                for ($i = 0; $i < 12; $i++) {
                    $jatuhtempo = date("Y-m-d", strtotime("+$i month", strtotime($awal_tempo)));
                    $bulan = $idnbulan[date('m', strtotime($jatuhtempo))] . " " . date('Y', strtotime($jatuhtempo));
                    Pembayaran::create([
                        'siswa_id' => $id->id,
                        'spp_id' => $request->jenisbayar,
                        'bulan' => $bulan,
                        'biaya' => $request->tarif,
                        'jatuh_tempo' => $jatuhtempo,
                        'keterangan' => "Belum Bayar",
                        // 'jumlah' => $spp->biaya,
                    ]);
                }
            }
        } else {

            $idsiswa = Siswa::where('kelas_id', $request->kelas)->get();

            foreach ($idsiswa as $id) {
                Pembayaran::create([
                    'siswa_id' => $id->id,
                    'spp_id' => $request->jenisbayar,
                    'bulan' => null,
                    'jatuh_tempo' => date("Y-m-d", strtotime('+1 month')),
                    'biaya' => $request->tarif,
                    'keterangan' => "Belum Bayar",
                ]);
            }
        }
        alert()->success('Behasil', 'Data berhasil ditambahkan.');
        return redirect()->back();
    }
}
