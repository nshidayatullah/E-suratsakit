<?php

namespace App\Filament\Resources\SuratSakitTercetaks\Pages;

use App\Filament\Resources\SuratSakitTercetaks\SuratSakitTercetakResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSuratSakitTercetak extends ViewRecord
{
    protected static string $resource = SuratSakitTercetakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // EditAction::make(),
        ];
    }
}
