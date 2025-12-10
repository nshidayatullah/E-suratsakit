<?php

namespace App\Filament\Resources\SuratSakitTercetaks\Pages;

use App\Filament\Resources\SuratSakitTercetaks\SuratSakitTercetakResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSuratSakitTercetaks extends ListRecords
{
    protected static string $resource = SuratSakitTercetakResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
