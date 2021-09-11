<?php

namespace App\Http\Controllers;

use datatables;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Golongan;
use App\Models\JenisKelamin;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $data = Pegawai::orderBy('id', 'DESC')->get();
        if(request()->ajax()){
            return datatables()->of($data)
                                ->addColumn('jabatan', function($data){
                                    return $data->jabatan->nama_jabatan;
                                })
                                ->addColumn('golongan', function($data){
                                    return $data->golongan->kode_golongan;
                                })
                                ->addColumn('jenis_kelamin', function($data){
                                    return $data->jenis_kelamin->nama_jenis_kelamin;
                                })
                                ->addColumn('opsi', function($data){
                                    $button = '<button class="btn btn-sm btn-success edit-pegawai" data-bs-toggle="modal" data-bs-target="#modal-edit-pegawai" id="'. $data->id .'">Edit</button>';
                                    $button .= '<button class="btn btn-sm btn-danger ms-1 hapus-pegawai" id="'. $data->id .'" nama-pegawai="'. $data->nama .'">Hapus</button>';
                                    return $button;
                                })
                                ->rawColumns(['jabatan','golongan','jenis_kelamin','opsi'])
                                ->make(true);
        }

        $jabatan = Jabatan::orderBy('nama_jabatan', 'ASC')->get();
        $golongan = Golongan::orderBy('kode_golongan', 'ASC')->get();
        $jenis_kelamin = JenisKelamin::orderBy('nama_jenis_kelamin', 'ASC')->get();

        return view('pegawai.pegawai', [
            'jabatan' => $jabatan,
            'golongan' => $golongan,
            'jenis_kelamin' => $jenis_kelamin
        ]);
    }

    public function detail($id)
    {
        $pegawai = Pegawai::find($id);

        return response()->json([
            'pegawai' => $pegawai
        ]);
    }

    public function tambahPegawai()
    {
        request()->validate([
            'nip' => 'required|unique:pegawais,nip',
            'nama' => 'required',
            'jabatan_id' => 'required',
            'golongan_id' => 'required',
            'jenis_kelamin_id' => 'required',
            'telepon' => 'required|numeric'
        ],[
            'nip.required' => 'NIP harus di isi',
            'nip.unique' => 'NIP ini sudah terdaftar',
            'nama.required' => 'Nama harus di isi',
            'jabatan_id.required' => 'Jabatan harus di pilih',
            'golongan_id.required' => 'Golongan harus di pilih',
            'jenis_kelamin_id.required' => 'Jenis kelamin harus di pilih',
            'telepon.required' => 'Telepon harus di isi',
            'telepon.numeric' => 'Data harus angka'
        ]);

        Pegawai::create([
            'nip' => strtoupper(request('nip')),
            'nama' => ucwords(request('nama')),
            'jabatan_id' => request('jabatan_id'),
            'golongan_id' => request('golongan_id'),
            'jenis_kelamin_id' => request('jenis_kelamin_id'),
            'telepon' => request('telepon')
        ]);

        return response()->json([
            'message' => 'pegawai berhasil ditambahkan'
        ]);
    }

    public function editPegawai($id)
    {
        $pegawai = Pegawai::find($id);

        request()->validate([
            'nama_edit' => 'required',
            'telepon_edit' => 'required|numeric'
        ],[
            'nama_edit.required' => 'Nama harus di isi',
            'telepon_edit.required' => 'Telepon harus di isi',
            'telepon_edit.numeric' => 'Data harus angka'
        ]);

        $pegawai->update([
            'nama' => ucwords(request('nama_edit')),
            'jabatan_id' => request('jabatan_id_edit'),
            'golongan_id' => request('golongan_id_edit'),
            'jenis_kelamin_id' => request('jenis_kelamin_id_edit'),
            'telepon' => request('telepon_edit')
        ]);

        return response()->json([
            'message' => 'pegawai berhasil ditambahkan'
        ]);
    }

    public function hapusPegawai($id)
    {
        $pegawai = Pegawai::find($id);

        $pegawai->delete();

        return response()->json([
            'message' => 'pegawai berhasil dihapus'
        ]);
    }
}
