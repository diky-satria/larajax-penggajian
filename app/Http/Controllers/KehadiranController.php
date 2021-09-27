<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KehadiranController extends Controller
{
    public function index()
    {
        return view('kehadiran.kehadiran');
    }

    public function cariKehadiran()
    {
        $bln = request('bulan');
        $thn = request('tahun');

        if($bln && $thn){
            $kehadiran = DB::select("SELECT gajis.*, pegawais.nama, pegawais.nip FROM gajis
                                    JOIN pegawais ON gajis.pegawai_id=pegawais.id
                                    WHERE gajis.bulan=$bln AND gajis.tahun=$thn");
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
                'data' => $kehadiran,
                'dataBulan' => $dataBulan
            ]);
        }
    }

    public function detailKehadiran($id)
    {
        $gaji = Gaji::find($id);

        $data = [
            'id' => $gaji->id,
            'nip' => $gaji->pegawai->nip,
            'nama' => $gaji->pegawai->nama,
            'sakit' => $gaji->sakit,
            'izin' => $gaji->izin,
            'alpha' => $gaji->alpha,
        ];

        return response()->json([
            'data' => $data
        ]);
    }

    public function editKehadiran($id)
    {
        $gaji = Gaji::find($id);

        request()->validate([
            'sakit' => 'required|numeric',
            'izin' => 'required|numeric',
            'alpha' => 'required|numeric'
        ],[
            'sakit.required' => 'Data harus di isi',
            'sakit.numeric' => 'Data harus angka',
            'izin.required' => 'Data harus di isi',
            'izin.numeric' => 'Data harus angka',
            'alpha.required' => 'Data harus di isi',
            'alpha.numeric' => 'Data harus angka',
        ]);

        $gaji->update([
            'sakit' => request('sakit'),
            'izin' => request('izin'),
            'alpha' => request('alpha')
        ]);

        return response()->json([
            'message' => 'detail kehadiran berhasil di edit'
        ]);
    }

    public function inputKehadiran()
    {
        return view('kehadiran.input_kehadiran');
    }

    public function generateKehadiran()
    {
        $bln = request('bulan');
        $thn = request('tahun');
        // $bulan = $bln.$thn;
        if($bln && $thn){
            $kehadiran = DB::select("SELECT pegawais.*, jabatans.nama_jabatan FROM pegawais
                                    JOIN jabatans ON pegawais.jabatan_id=jabatans.id
                                    JOIN golongans ON pegawais.golongan_id=golongans.id
                                    WHERE NOT EXISTS (SELECT * FROM gajis WHERE bulan='$bln' AND tahun='$thn')");
            $data = [];
            foreach($kehadiran as $k){
                $data[] = [
                    'id' => $k->id,
                    'nip' => $k->nip,
                    'nama' => $k->nama
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

    public function inputDataKehadiran()
    {
        $bulan = request('bulan');
        $tahun = request('tahun');
        $pegawai = request('pegawai_id');
        $sakit = request('sakit');
        $izin = request('izin');
        $alpha = request('alpha');

        $count = count($pegawai);

        for($i=0;$i<$count;$i++){
            Gaji::create([
                'bulan' => $bulan[$i],
                'tahun' => $tahun[$i],
                'pegawai_id' => $pegawai[$i],
                'sakit' => $sakit[$i],
                'izin' => $izin[$i],
                'alpha' => $alpha[$i]
            ]);
        }

        return response()->json([
            'message' => 'kehadiran berhasil di input'
        ]);
    }
}
