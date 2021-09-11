<?php

namespace App\Http\Controllers;

use datatables;
use App\Models\Golongan;
use Illuminate\Http\Request;

class GolonganController extends Controller
{
    public function index()
    {
        $data = Golongan::orderBy('id', 'DESC')->get();
        if(request()->ajax()){
            return datatables()->of($data)
                                ->addColumn('uang_makan', function($data){
                                    return format_rupiah($data->uang_makan);
                                })
                                ->addColumn('uang_lembur', function($data){
                                    return format_rupiah($data->uang_lembur);
                                })
                                ->addColumn('asuransi_kesehatan', function($data){
                                    return format_rupiah($data->asuransi_kesehatan);
                                })
                                ->addColumn('opsi', function($data){
                                    $button = '<button class="btn btn-sm btn-success edit-golongan" data-bs-toggle="modal" data-bs-target="#modal-edit-golongan" id="'. $data->id .'">Edit</button>';
                                    $button .= '<button class="btn btn-sm btn-danger ms-1 hapus-golongan" id="'. $data->id .'" kode-golongan="'. $data->kode_golongan .'">Hapus</button>';
                                    return $button;
                                })
                                ->rawColumns(['uang_makan','uang_lembur','asuransi_kesehatan','opsi'])
                                ->make(true);
        }

        return view('golongan.golongan');
    }

    public function detail($id)
    {
        $golongan = Golongan::find($id);

        return response()->json([
            'message' => 'detail golongan',
            'golongan' => $golongan
        ]);
    }

    public function tambahGolongan()
    {
        request()->validate([
            'kode_golongan' => 'required|unique:golongans,kode_golongan',
            'uang_makan' => 'required|numeric',
            'uang_lembur' => 'required|numeric',
            'asuransi_kesehatan' => 'required|numeric'
        ],[
            'kode_golongan.required' => 'Kode golongan harus di isi',
            'kode_golongan.unique' => 'Kode golongan sudah terdaftar',
            'uang_makan.required' => 'Uang makan harus di isi',
            'uang_makan.numeric' => 'Uang makan harus angka',
            'uang_lembur.required' => 'Uang lembur harus di isi',
            'uang_lembur.numeric' => 'Uang lembur harus angka',
            'asuransi_kesehatan.required' => 'Asuransi kesehatan harus di isi',
            'asuransi_kesehatan.numeric' => 'Asuransi kesehatan harus angka',
        ]);

        Golongan::create([
            'kode_golongan' => strtoupper(request('kode_golongan')),
            'uang_makan' => request('uang_makan'),
            'uang_lembur' => request('uang_lembur'),
            'asuransi_kesehatan' => request('asuransi_kesehatan')
        ]);

        return response()->json([
            'message' => 'golongan berhasil ditambahkan'
        ]);
    }

    public function editGolongan($id)
    {
        $golongan = Golongan::find($id);

        request()->validate([
            'uang_makan_edit' => 'required|numeric',
            'uang_lembur_edit' => 'required|numeric',
            'asuransi_kesehatan_edit' => 'required|numeric'
        ],[
            'uang_makan_edit.required' => 'Uang makan harus di isi',
            'uang_makan_edit.numeric' => 'Uang makan harus angka',
            'uang_lembur_edit.required' => 'Uang lembur harus di isi',
            'uang_lembur_edit.numeric' => 'Uang lembur harus angka',
            'asuransi_kesehatan_edit.required' => 'Asuransi kesehatan harus di isi',
            'asuransi_kesehatan_edit.numeric' => 'Asuransi kesehatan harus angka',
        ]);

        $golongan->update([
            'uang_makan' => request('uang_makan_edit'),
            'uang_lembur' => request('uang_lembur_edit'),
            'asuransi_kesehatan' => request('asuransi_kesehatan_edit')
        ]);

        return response()->json([
            'message' => 'golongan berhasil diedit'
        ]);
    }

    public function hapusGolongan($id)
    {
        $golongan = Golongan::find($id);

        $golongan->delete();

        return response()->json([
            'message' => 'golongan berhasil dihapus',
        ]);
    }
}
