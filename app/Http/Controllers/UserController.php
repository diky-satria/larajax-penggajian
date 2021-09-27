<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function riwayat()
    {
        $pegawai = Pegawai::where('email', Auth::user()->email)->first();

        date_default_timezone_set('Asia/Jakarta');
        $date = date('n-Y');

        // memecah string date menjadi array
        $datePecah = explode("-", $date);
        // menampung string yang sudah di pecah ke arr associative agar lebih mudah
        $arrAssoc = [
            'bulan' => $datePecah[0],
            'tahun' => $datePecah[1]
        ];

        $riwayat = Gaji::where('pegawai_id', $pegawai->id)->where('tahun', $arrAssoc['tahun'])->orderBy('bulan', 'DESC')->get();



        // LOGIC ALGORITMA UNTUK MEMISAHKAN DATA DALAM FIELD DATABASE CONTOH DATA '12021' ANGKA 1 INGIN DIPISAH DENGAN 2021

        // $tanggal = [];
        // $val = [];
        // $bln = '';
        // $id = [];

        // memecah bulan dengan explode
        // foreach($riwayat as $r){
        //     $val[] = explode(" ",$r->bulan);
        // }

        
        // setelah dapat nilai dari explode lalu pisahkan nilai bulan dan tahun 
        // for($i=0; $i<count($val); $i++){

            // if($val[$i][0][0] == 1){
            //     $bln = 'Januari';
            // }elseif($val[$i][0][0] == 2){
            //     $bln = 'Februari';
            // }elseif($val[$i][0][0] == 3){
            //     $bln = 'Maret';
            // }elseif($val[$i][0][0] == 4){
            //     $bln = 'April';
            // }elseif($val[$i][0][0] == 5){
            //     $bln = 'Mei';
            // }elseif($val[$i][0][0] == 6){
            //     $bln = 'Juni';
            // }elseif($val[$i][0][0] == 7){
            //     $bln = 'Juli';
            // }elseif($val[$i][0][0] == 8){
            //     $bln = 'Agustus';
            // }elseif($val[$i][0][0] == 9){
            //     $bln = 'September';
            // }elseif($val[$i][0][0] == 10){
            //     $bln = 'Oktober';
            // }elseif($val[$i][0][0] == 11){
            //     $bln = 'November';
            // }elseif($val[$i][0][0] == 12){
            //     $bln = 'Desember';
            // }

            // ubah data menjadi array associative agar lebih mudah di eksekusi
        //     $tanggal[] = [
        //         'bulanHuruf' => $bln,
        //         'bulanAngka' => $val[$i][0][0],
        //         'tahunPisah' => $val[$i][0][1] . $val[$i][0][2] . $val[$i][0][3] . $val[$i][0][4],
        //         'tahunGabung' => $val[$i][0][0] . $val[$i][0][1] . $val[$i][0][2] . $val[$i][0][3] . $val[$i][0][4]
        //     ];  
        // }

        // AKHIR LOGIC ALGORITMA


        

        // push data
        $data = [];
        foreach($riwayat as $r){

            // bulan dalam huruf
            if($r->bulan == 1){
                $dataBulan = 'Januari';
            }elseif($r->bulan == 2){
                $dataBulan = 'Februari';
            }elseif($r->bulan == 3){
                $dataBulan = 'Maret';
            }elseif($r->bulan == 4){
                $dataBulan = 'April';
            }elseif($r->bulan == 5){
                $dataBulan = 'Mei';
            }elseif($r->bulan == 6){
                $dataBulan = 'Juni';
            }elseif($r->bulan == 7){
                $dataBulan = 'Juli';
            }elseif($r->bulan == 8){
                $dataBulan = 'Agustus';
            }elseif($r->bulan == 9){
                $dataBulan = 'September';
            }elseif($r->bulan == 10){
                $dataBulan = 'Oktober';
            }elseif($r->bulan == 11){
                $dataBulan = 'November';
            }elseif($r->bulan == 12){
                $dataBulan = 'Desember';
            }

            $data[] = [
                'dataBulanAngka' => $r->bulan,
                'dataBulan' => $dataBulan,
                'dataTahun' => $r->tahun
            ];
        }

        return response()->json([
            // 'tanggal' => $tanggal,
            'data' => $data, 
        ]);
    }

    public function detail($bulan, $tahun)
    {
        $pegawai = Pegawai::where('email', Auth::user()->email)->first();
        $gaji = Gaji::where(['pegawai_id' => $pegawai->id, 'bulan' => $bulan, 'tahun' => $tahun])->first();

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

    public function profilPassword()
    {
        return view('user.profilPassword');
    }

    public function userData()
    {
        if(Auth::user()->role == 'user'){
            $user = Pegawai::where('email', Auth::user()->email)->first();
            $jabatan = $user->jabatan()->first();
            $golongan = $user->golongan()->first();
        }else{
            $user = 0;
            $jabatan = 0;
            $golongan = 0;
        }

        return response()->json([
            'user' => $user,
            'jabatan' => $jabatan,
            'golongan' => $golongan
        ]);
    }

    public function ubahPassword()
    {
        request()->validate([
            'password' => 'required|min:6',
            'konfirmasi-password' => 'required|same:password'
        ],[
            'password.required' => 'Password harus di isi',
            'password.min' => 'Password minimal 6 karakter',
            'konfirmasi-password.required' => 'Konfirmasi password harus di isi',
            'konfirmasi-password.same' => 'Konfirmasi password salah' 
        ]);

        $user = User::where('email', Auth::user()->email)->first();
        $user->update([
            'password' => bcrypt(request('password'))
        ]);

        return response()->json([
            'message' => 'password berhasil di ubah'
        ]);
    }
}
