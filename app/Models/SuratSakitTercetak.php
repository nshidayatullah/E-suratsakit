<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratSakitTercetak extends Model
{
    protected $table = 'cetak_surat_sakits';

    protected $fillable = [
        'surat_sakit_id',
        'short_code',
        'nama',
        'umur',
        'jabatan',
        'departemen',
        'keluhan',
        'tanggal_surat',
        'jam_keluar_surat',
        'petugas',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
    ];

    public function suratSakit()
    {
        return $this->belongsTo(SuratSakit::class);
    }
}
