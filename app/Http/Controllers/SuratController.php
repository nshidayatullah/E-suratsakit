<?php

namespace App\Http\Controllers;

use App\Models\CetakSuratSakit;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratController extends Controller
{
    public function cetak($shortCode)
    {
        $surat = CetakSuratSakit::where('short_code', $shortCode)->firstOrFail();
        return view('surat.cetak', compact('surat'));
    }

    public function download($shortCode)
    {
        $surat = CetakSuratSakit::where('short_code', $shortCode)->firstOrFail();

        $pdf = Pdf::loadView('surat.pdf', compact('surat'))
            ->setPaper('a5', 'portrait');

        return $pdf->stream('Surat_Sakit_' . $surat->nama . '.pdf');
    }

    public function downloadPdf($shortCode)
    {
        $surat = CetakSuratSakit::where('short_code', $shortCode)->firstOrFail();

        $pdf = Pdf::loadView('surat.pdf', compact('surat'))
            ->setPaper('a5', 'portrait');

        return $pdf->download('Surat_Sakit_' . $surat->nama . '.pdf');
    }

    public function downloadPage()
    {
        return view('surat.download-page');
    }

    public function downloadSubmit(Request $request)
    {
        $request->validate([
            'short_code' => 'required|string|size:4',
        ]);

        $surat = CetakSuratSakit::where('short_code', strtoupper($request->short_code))->first();

        if (!$surat) {
            return back()->withErrors(['short_code' => 'Kode tidak ditemukan'])->withInput();
        }

        return redirect()->route('surat.download', $surat->short_code);
    }

    public function verify($shortCode)
    {
        $surat = CetakSuratSakit::where('short_code', $shortCode)->first();

        if (!$surat) {
            return view('surat.verify', ['valid' => false]);
        }

        return view('surat.verify', ['valid' => true, 'surat' => $surat]);
    }
}
