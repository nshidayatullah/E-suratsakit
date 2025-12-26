<?php

namespace App\Filament\Resources\SuratSakitTercetaks\Pages;

use App\Models\CetakSuratSakit;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SuratSakitTercetaks\SuratSakitTercetakResource;

class ListSuratSakitTercetaks extends ListRecords
{
    protected static string $resource = SuratSakitTercetakResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTabs(): array
    {
        $departments = CetakSuratSakit::select('departemen')
            ->distinct()
            ->whereNotNull('departemen')
            ->orderBy('departemen')
            ->pluck('departemen')
            ->toArray();

        $tabs = [
            'semua' => Tab::make('Semua')
                ->badge(CetakSuratSakit::count()),
        ];

        foreach ($departments as $dept) {
            $tabs[$dept] = Tab::make($dept)
                ->badge(CetakSuratSakit::where('departemen', $dept)->count())
                ->modifyQueryUsing(fn(Builder $query) => $query->where('departemen', $dept));
        }

        return $tabs;
    }
}
