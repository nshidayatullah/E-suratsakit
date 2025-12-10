<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratSakit extends Model
{
    protected $fillable = [
        'no',
        'nrp',
        'nama',
        'umur',
        'jabatan',
        'departemen',
        'keluhan',
        'jam_keluar_surat',
        'tanggal_surat',
        'ttd_petugas',
        'petugas',
        'is_published',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
        'is_published' => 'boolean',
    ];
}
