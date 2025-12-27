<?php

namespace App\Filament\Widgets;

use App\Models\CetakSuratSakit;
use App\Models\SuratSakit;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $hariIni = CetakSuratSakit::whereDate('created_at', Carbon::today())->count();
        $mingguIni = CetakSuratSakit::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();
        $bulanIni = CetakSuratSakit::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        $belumTerbit = SuratSakit::where('is_published', false)->count();

        return [
            Stat::make('Surat Hari Ini', $hariIni)
                ->description('Diterbitkan hari ini')
                ->icon('heroicon-o-document-check')
                ->color('success'),
            Stat::make('Surat Minggu Ini', $mingguIni)
                ->description('Diterbitkan minggu ini')
                ->icon('heroicon-o-calendar')
                ->color('info'),
            Stat::make('Surat Bulan Ini', $bulanIni)
                ->description('Diterbitkan bulan ini')
                ->icon('heroicon-o-calendar-days')
                ->color('warning'),
            Stat::make('Belum Terbit', $belumTerbit)
                ->description('Menunggu diterbitkan')
                ->icon('heroicon-o-clock')
                ->color('danger'),
        ];
    }
}
