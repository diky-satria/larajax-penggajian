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
        $bulan = $bln.$thn;

        if($bln && $thn){
            $kehadiran = DB::select("SELECT gajis.*, pegawais.nama, pegawais.nip FROM gajis
                                    JOIN pegawais ON gajis.pegawai_id=pegawais.id
                                    WHERE gajis.bulan=$bulan");
            return response()->json([
                'data' => $kehadiran
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
        $bulan = $bln.$thn;
        if($bln && $thn){
            $kehadiran = DB::select("SELECT pegawais.*, jabatans.nama_jabatan FROM pegawais
                                    JOIN jabatans ON pegawais.jabatan_id=jabatans.id
                                    JOIN golongans ON pegawais.golongan_id=golongans.id
                                    WHERE NOT EXISTS (SELECT * FROM gajis WHERE bulan='$bulan')");
            $data = [];
            foreach($kehadiran as $k){
                $data[] = [
                    'id' => $k->id,
                    'nip' => $k->nip,
                    'nama' => $k->nama
                ];
            }
            return response()->json([
                'data' => $data,
            ]);
        }
    }

    public function inputDataKehadiran()
    {
        $bulan = request('bulan');
        $pegawai = request('pegawai_id');
        $sakit = request('sakit');
        $izin = request('izin');
        $alpha = request('alpha');

        $count = count($pegawai);

        for($i=0;$i<$count;$i++){
            Gaji::create([
                'bulan' => $bulan[$i],
                'pegawai_id' => $pegawai[$i],
                'sakit' => $sakit[$i],
                'izin' => $izin[$i],
                'alpha' => $alpha[$i]
            ]);
        }

        return redirect('kehadiran');
    }
}
