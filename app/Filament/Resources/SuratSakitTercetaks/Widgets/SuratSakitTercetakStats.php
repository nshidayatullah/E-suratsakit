<?php

namespace App\Filament\Resources\SuratSakitTercetaks\Widgets;

use App\Models\CetakSuratSakit;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class SuratSakitTercetakStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $hariIni = CetakSuratSakit::whereDate('created_at', Carbon::today())->count();
        $mingguIni = CetakSuratSakit::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $bulanIni = CetakSuratSakit::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        $total = CetakSuratSakit::count();

        return [
            Stat::make('Hari Ini', $hariIni)
                ->description('Surat diterbitkan hari ini')
                ->icon('heroicon-o-document-check')
                ->color('success'),
            Stat::make('Minggu Ini', $mingguIni)
                ->description('Surat diterbitkan minggu ini')
                ->icon('heroicon-o-calendar')
                ->color('info'),
            Stat::make('Bulan Ini', $bulanIni)
                ->description('Surat diterbitkan bulan ini')
                ->icon('heroicon-o-calendar-days')
                ->color('warning'),
            Stat::make('Total', $total)
                ->description('Total semua surat')
                ->icon('heroicon-o-document-duplicate')
                ->color('gray'),
        ];
    }
}
