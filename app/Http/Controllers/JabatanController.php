<?php

namespace App\Http\Controllers;

use datatables;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller 
{
    public function index()
    {
        $data = Jabatan::orderBy('id', 'DESC')->get();
        if(request()->ajax()){
            return datatables()->of($data)
                                ->addColumn('gaji_pokok', function($data){
                                    return format_rupiah($data->gaji_pokok);
                                })
                                ->addColumn('tunjangan', function($data){
                                    return format_rupiah($data->tunjangan);
                                })
                                ->addColumn('opsi', function($data){
                                    $button = "<button class='btn btn-sm btn-success modal-edit-jabatan' data-bs-toggle='modal' data-bs-target='#modal-edit-jabatan' id='". $data->id ."'>Edit</button>";
                                    $button .= "<button class='btn btn-sm btn-danger ms-1 hapus-jabatan' id='". $data->id ."' nama-jabatan='". $data->nama_jabatan ."'>Hapus</button>";
                                    return $button;
                                })
                                ->rawColumns(['tunjangan','gaji_pokok','opsi'])
                                ->make(true);
        }
        return view('jabatan.jabatan'); 
    }

    public function tambahJabatan()
    {
        request()->validate([
            'kode_jabatan' => 'required|unique:jabatans,kode_jabatan',
            'nama_jabatan' => 'required',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'required|numeric'
        ],[
            'kode_jabatan.required' => 'Kode jabatan harus di isi',
            'kode_jabatan.unique' => 'Kode sudah terdaftar',
            'nama_jabatan.required' => 'Nama jabatan harus di isi',
            'gaji_pokok.required' => 'Gaji pokok harus di isi',
            'gaji_pokok.numeric' => 'Gaji pokok harus angka',
            'tunjangan.required' => 'Tunjangan harus di isi',
            'tunjangan.numeric' => 'Tunjangan harus angka',
        ]);

        Jabatan::create([
            'kode_jabatan' => strtoupper(request('kode_jabatan')),
            'nama_jabatan' => ucwords(request('nama_jabatan')),
            'gaji_pokok' => request('gaji_pokok'),
            'tunjangan' => request('tunjangan')
        ]);

        return response()->json([
            'message' => 'jabatan berhasil ditambahkan'
        ]);
    }

    public function detail($id)
    {
        $jabatan = Jabatan::find($id);

        return response()->json([
            'message' => 'detail jabatan',
            'jabatan' => $jabatan
        ]);
    }

    public function editJabatan($id)
    {
        $jabatan = Jabatan::find($id);

        request()->validate([
            'nama_jabatan_edit' => 'required',
            'gaji_pokok_edit' => 'required|numeric',
            'tunjangan_edit' => 'required|numeric'
        ],[
            'nama_jabatan_edit.required' => 'Nama jabatan harus di isi',
            'gaji_pokok_edit.required' => 'Gaji pokok harus di isi',
            'gaji_pokok_edit.numeric' => 'Gaji pokok harus angka',
            'tunjangan_edit.required' => 'Tunjangan harus di isi',
            'tunjangan_edit.numeric' => 'Tunjangan harus angka',
        ]);

        $jabatan->update([
            'nama_jabatan' => ucwords(request('nama_jabatan_edit')),
            'gaji_pokok' => request('gaji_pokok_edit'),
            'tunjangan' => request('tunjangan_edit')
        ]);

        return response()->json([
            'message' => 'data jabatan berhasil di edit'
        ]);
    }

    public function hapusJabatan($id)
    {
        $jabatan = Jabatan::find($id);

        $jabatan->delete();

        return response()->json([
            'message' => 'jabatan berhasil dihapus'
        ]);
    }
}
