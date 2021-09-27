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

        if($bln && $thn){
            // $gaji = DB::select("SELECT gajis.*, pegawais.nip, pegawais.nama FROM gajis
            //                     JOIN pegawais ON gajis.pegawai_id = pegawais.id
            //                     WHERE gajis.bulan=$bln AND gajis.tahun=$thn");

            $gaji = Gaji::where(['bulan' => $bln, 'tahun' => $thn])->get();

            $data = [];
            foreach($gaji as $g){
                $data[] = [
                    'id' => $g->id,
                    'nip' => $g->pegawai->nip,
                    'nama' => $g->pegawai->nama,
                    'sakit' => $g->sakit,
                    'izin' => $g->izin,
                    'alpha' => $g->alpha
                ];
            }

            // bulan dalam huruf
            if($bln == 1){
                $dataBulan = 'Januari';
            }elseif($bln == 2){
                $dataBulan = 'Februari';
            }elseif($bln == 3){
                $dataBulan = 'Maret';
            }elseif($bln == 4){
                $dataBulan = 'April';
            }elseif($bln == 5){
                $dataBulan = 'Mei';
            }elseif($bln == 6){
                $dataBulan = 'Juni';
            }elseif($bln == 7){
                $dataBulan = 'Juli';
            }elseif($bln == 8){
                $dataBulan = 'Agustus';
            }elseif($bln == 9){
                $dataBulan = 'September';
            }elseif($bln == 10){
                $dataBulan = 'Oktober';
            }elseif($bln == 11){
                $dataBulan = 'November';
            }elseif($bln == 12){
                $dataBulan = 'Desember';
            }

            return response()->json([
                'data' => $data,
                'dataBulan' => $dataBulan
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
