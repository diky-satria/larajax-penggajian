<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $fillable = ['bulan','tahun','pegawai_id','sakit','izin','alpha'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
