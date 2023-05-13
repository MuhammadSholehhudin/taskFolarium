<?php

namespace App\Models;

use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Model;

class Kontrak extends Model
{
    protected $table = 'kontrak';
    protected $primaryKey = 'id_kontrak';
    protected $fillable = [
        'id_pegawai',
        'id_jabatan',
        'tgl_mulai_kontrak',
        'tgl_berakhir_kontrak'
    ];
    public $timestamps = true;

    public function pegawai(){
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function jabatan(){
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }
}
