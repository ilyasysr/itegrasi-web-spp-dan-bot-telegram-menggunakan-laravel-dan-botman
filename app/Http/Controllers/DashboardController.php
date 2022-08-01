<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Spp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Month;

class DashboardController extends Controller
{
    public function index()
    {
        date_default_timezone_set("Asia/Jakarta");
        //ambil jam dan menit
        $jam = date('H:i');
        //atur salam
        if ($jam > '00:01' && $jam < '10:00') {
            $salam = 'Pagi';
        } elseif ($jam >= '10:00' && $jam < '15:00') {
            $salam = 'Siang';
        } elseif ($jam < '18:00') {
            $salam = 'Sore';
        } else {
            $salam = 'Malam';
        }

        $siswa = Siswa::count();
        $kelas = Kelas::count();

        $user = User::count();
        $pembayaran = Spp::count();

        $pendapatan = DB::table('pembayarans')
            ->join('spps', 'spp_id', '=', 'spps.id')
            ->where('keterangan', '=', 'LUNAS')
            ->sum('biaya');

        //History Pembayaran
        $history = Pembayaran::with(['siswa', 'spp'])
            ->where('keterangan', 'LUNAS')->orderBy('no_bayar', 'desc')->get();

        //Tagihan Pembayaran
        // $tgl = Carbon::now()->format('Y-m-d');
        $tagihan = Pembayaran::with(['siswa', 'spp'])
            ->where('jatuh_tempo', '<=', Carbon::today())->where('keterangan', 'Belum Bayar')->orWhere('keterangan', 'DIBATALKAN')
            ->get();

        //Jumlah Tagihan
        $totaltagihan = DB::table('pembayarans')
            ->join('spps', 'spp_id', '=', 'spps.id')
            ->where('keterangan', '=', 'Belum Bayar')->where('jatuh_tempo', '<=', Carbon::today())
            ->sum('biaya');

        //Jumlah Pemasukan hari ini
        $day_in = DB::table('pembayarans')
            ->join('spps', 'spp_id', '=', 'spps.id')
            ->where('keterangan', '=', 'LUNAS')->where('tgl_bayar', '=', date(today()))
            ->sum('biaya');

        $now = Carbon::now();
        $bulan = $now->month;
        $tahun = $now->year;
        //Jumlah Pemasukan bulan ini
        $month_in = DB::table('pembayarans')
            ->join('spps', 'spp_id', '=', 'spps.id')
            ->where('keterangan', '=', 'LUNAS')->whereMonth('tgl_bayar', '=', $bulan)
            ->sum('biaya');
        //Jumlah Pemasukan tahun ini
        $year_in = DB::table('pembayarans')
            ->join('spps', 'spp_id', '=', 'spps.id')
            ->where('keterangan', '=', 'LUNAS')->whereYear('tgl_bayar', '=', $tahun)
            ->sum('biaya');


        return view('admin.dashboard', compact(
            'siswa',
            'kelas',
            'pendapatan',
            'user',
            'salam',
            'history',
            'tagihan',
            'totaltagihan',
            'pembayaran',
            'day_in',
            'month_in',
            'year_in'
        ));
    }
}
