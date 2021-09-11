<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SlipgajiController extends Controller
{
    public function index()
    {
        return view('slipgaji.slipgaji');
    }

    public function cari()
    {
        $bln = request('bulan');
        $thn = request('tahun');
        $bulan = $bln.$thn;

        if($bln && $thn){
            $gaji = DB::select("SELECT gajis.*, pegawais.nip, pegawais.nama FROM gajis
                                JOIN pegawais ON gajis.pegawai_id = pegawais.id
                                WHERE gajis.bulan=$bulan");

            $data = [];
            foreach($gaji as $g){
                $data[] = [
                    'id' => $g->id,
                    'nip' => $g->nip,
                    'nama' => $g->nama,
                    'sakit' => $g->sakit,
                    'izin' => $g->izin,
                    'alpha' => $g->alpha
                ];
            }

            return response()->json([
                'data' => $data 
            ]);
        }
    }

    public function detail($id)
    {
        $gaji = Gaji::find($id);
        $data = [
            'nip' => $gaji->pegawai->nip,
            'nama' => $gaji->pegawai->nama,
            'jabatan' => $gaji->pegawai->jabatan->nama_jabatan,
            'golongan' => $gaji->pegawai->golongan->kode_golongan,
            'izin' => $gaji->izin,
            'alpha' => $gaji->alpha,
            'asuransi' => $gaji->pegawai->golongan->asuransi_kesehatan,
            'gaji' => $gaji->pegawai->jabatan->gaji_pokok,
            'tunjangan' => $gaji->pegawai->jabatan->tunjangan
        ];

        return response()->json([
            'data' => $data
        ]);
    }
}
