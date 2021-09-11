<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Golongan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.dashboard');
    }

    public function ambilData()
    {
        $pegawai = Pegawai::all()->count();
        $jabatan = Jabatan::all()->count();
        $golongan = Golongan::all()->count();

        // data line chart
        $d_jabatan = Jabatan::orderBy('nama_jabatan', 'ASC')->get();
        $nama_jabatan = [];
        $gaji_pokok = [];
        $tunjangan = [];

        foreach($d_jabatan as $dj){
            $nama_jabatan[] = $dj->nama_jabatan;
            $gaji_pokok[] = $dj->gaji_pokok;
            $tunjangan[] = $dj->tunjangan;
        }

        // data bar chart
        $d_golongan = Golongan::orderBy('kode_golongan', 'ASC')->get();
        $kode_golongan = [];
        $uang_lembur = [];

        foreach($d_golongan as $dg){
            $kode_golongan[] = $dg->kode_golongan;
            $uang_lembur[] = $dg->uang_lembur;
        }

        // data doughnut chart
        $laki_laki = Pegawai::where('jenis_kelamin_id', 1)->count();
        $perempuan = Pegawai::where('jenis_kelamin_id', 2)->count();

        return response()->json([
            'pegawai' => $pegawai,
            'jabatan' => $jabatan,
            'golongan' => $golongan,
            'nama_jabatan' => $nama_jabatan,
            'gaji_pokok' => $gaji_pokok,
            'tunjangan' => $tunjangan,
            'kode_golongan' => $kode_golongan,
            'uang_lembur' => $uang_lembur,
            'laki_laki' => $laki_laki,
            'perempuan' => $perempuan
        ]);
    }
}
