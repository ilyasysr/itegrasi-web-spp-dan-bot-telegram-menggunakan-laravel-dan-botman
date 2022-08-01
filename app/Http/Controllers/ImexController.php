<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ImportSiswa;
use App\Exports\ExportSiswa;
use Maatwebsite\Excel\Facades\Excel;

class ImexController extends Controller
{
    public function import_data()
    {
        Excel::import(new ImportSiswa, request()->file('file'));
        return redirect()->back();
    }
    public function export_data()
    {
        return Excel::download(new ExportSiswa, 'data_siswa.xlsx');
        return redirect()->back();
    }
}
