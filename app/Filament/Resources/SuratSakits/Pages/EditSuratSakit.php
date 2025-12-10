<?php

namespace App\Filament\Resources\SuratSakits\Pages;

use App\Filament\Resources\SuratSakits\SuratSakitResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSuratSakit extends EditRecord
{
    protected static string $resource = SuratSakitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
