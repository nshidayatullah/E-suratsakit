<?php

namespace App\Filament\Widgets;

use App\Models\CetakSuratSakit;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class SuratSakitPerDepartemenChart extends ChartWidget
{
    public function getHeading(): string
    {
        return 'Surat Sakit per Departemen (Bulan Ini)';
    }

    protected function getData(): array
    {
        $data = CetakSuratSakit::selectRaw('departemen, COUNT(*) as total')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereNotNull('departemen')
            ->groupBy('departemen')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Surat',
                    'data' => $data->pluck('total')->toArray(),
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)',
                        'rgba(199, 199, 199, 0.7)',
                        'rgba(83, 102, 255, 0.7)',
                        'rgba(255, 99, 255, 0.7)',
                        'rgba(99, 255, 132, 0.7)',
                    ],
                ],
            ],
            'labels' => $data->pluck('departemen')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
