<?php

namespace App\Services;

use App\Models\SuratSakit;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GoogleSheetsService
{
    public function sync(): array
    {
        $apiKey = env('GOOGLE_SHEETS_API_KEY');
        $spreadsheetId = env('GOOGLE_SHEETS_SPREADSHEET_ID');
        $range = env('GOOGLE_SHEETS_RANGE');

        $url = sprintf(
            'https://sheets.googleapis.com/v4/spreadsheets/%s/values/%s?key=%s',
            $spreadsheetId,
            urlencode($range),
            $apiKey
        );

        $response = Http::timeout(60)->get($url);

        if ($response->failed()) {
            return ['success' => false, 'message' => 'Gagal konek ke Google Sheets'];
        }

        $rows = $response->json()['values'] ?? [];

        if (count($rows) < 2) {
            return ['success' => false, 'message' => 'Data kosong'];
        }

        // Skip header
        array_shift($rows);

        $synced = 0;
        $skipped = 0;

        DB::beginTransaction();
        try {
            foreach ($rows as $row) {
                // Skip baris kosong atau tidak punya NRP
                $nrp = $row[1] ?? null;
                if (empty($nrp)) {
                    $skipped++;
                    continue;
                }

                SuratSakit::updateOrCreate(
                    [
                        'nrp' => $nrp,
                        'tanggal_surat' => $this->parseDate($row[8] ?? null),
                        'jam_keluar_surat' => $row[7] ?? null,
                    ],
                    [
                        'no' => !empty($row[0]) ? (int) $row[0] : null,
                        'nama' => $row[2] ?? null,
                        'umur' => !empty($row[3]) ? (int) $row[3] : null,
                        'jabatan' => $row[4] ?? null,
                        'departemen' => $row[5] ?? null,
                        'keluhan' => $row[6] ?? null,
                        'ttd_petugas' => $row[9] ?? null,
                        'petugas' => $row[10] ?? null,
                    ]
                );
                $synced++;
            }
            DB::commit();

            return ['success' => true, 'message' => "Sync berhasil: {$synced} data, {$skipped} dilewati"];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    protected function parseDate(?string $date): ?string
    {
        if (empty($date)) return null;

        try {
            return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
