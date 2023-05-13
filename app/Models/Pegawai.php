<?php

namespace App\Models;
use App\Models\Jabatan;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';
    protected $fillable = [
        'id_pegawai',
        'nama_pegawai',
        'id_jabatan'
    ];
    public $timestamps = true;

    public function jabatan(){
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }
}
