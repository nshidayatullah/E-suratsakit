<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SuratSakit;
use Illuminate\Http\Request;
use Carbon\Carbon;

class WebhookController extends Controller
{
    public function storeSuratSakit(Request $request)
    {
        // Validasi secret key
        if ($request->header('X-Secret-Key') !== env('WEBHOOK_SECRET_KEY')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $data = $request->all();

        // Cek apakah sudah ada
        $exists = SuratSakit::where('nrp', $data['nrp'])
            ->where('tanggal_surat', $data['tanggal_surat'])
            ->where('jam_keluar_surat', $data['jam_keluar_surat'])
            ->exists();

        if ($exists) {
            return response()->json(['success' => true, 'message' => 'Data sudah ada']);
        }

        SuratSakit::create([
            'nrp' => $data['nrp'],
            'no' => $data['no'] ?? null,
            'nama' => $data['nama'],
            'umur' => $data['umur'] ?? null,
            'jabatan' => $data['jabatan'] ?? null,
            'departemen' => $data['departemen'] ?? null,
            'keluhan' => $data['keluhan'] ?? null,
            'jam_keluar_surat' => $data['jam_keluar_surat'] ?? null,
            'tanggal_surat' => $data['tanggal_surat'],
            'ttd_petugas' => $data['ttd_petugas'] ?? null,
            'petugas' => $data['petugas'] ?? null,
        ]);

        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']);
    }
}
