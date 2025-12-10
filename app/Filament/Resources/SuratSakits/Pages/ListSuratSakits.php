<?php

namespace App\Filament\Resources\SuratSakits\Pages;

use App\Filament\Resources\SuratSakits\SuratSakitResource;
use App\Services\GoogleSheetsService;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Notifications\Notification;

class ListSuratSakits extends ListRecords
{
    protected static string $resource = SuratSakitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('sync')
                ->label('Sync dari Google Sheets')
                ->icon('heroicon-o-arrow-path')
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Sync Data')
                ->modalDescription('Data akan disinkronkan dari Google Sheets.')
                ->action(function () {
                    $result = app(GoogleSheetsService::class)->sync();

                    if ($result['success']) {
                        Notification::make()
                            ->title('Sync Berhasil')
                            ->body($result['message'])
                            ->success()
                            ->send();
                    } else {
                        Notification::make()
                            ->title('Sync Gagal')
                            ->body($result['message'])
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}
