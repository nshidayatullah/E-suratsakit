<?php

namespace App\Filament\Resources\SuratSakits\Pages;

use App\Filament\Resources\SuratSakits\SuratSakitResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSuratSakit extends ViewRecord
{
    protected static string $resource = SuratSakitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
