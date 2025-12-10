<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CetakSuratSakit extends Model
{
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

    public static function generateShortCode(): string
    {
        do {
            $code = rand(0, 9) . strtoupper(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 3));
        } while (self::where('short_code', $code)->exists());

        return $code;
    }
}
