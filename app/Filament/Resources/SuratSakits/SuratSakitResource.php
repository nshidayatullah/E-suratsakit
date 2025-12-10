<?php

namespace App\Filament\Resources\SuratSakits;

use App\Models\SuratSakit;
use App\Models\CetakSuratSakit;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Tables\Filters\SelectFilter;
use Filament\Notifications\Notification;
use App\Filament\Resources\SuratSakits\Pages;
use App\Filament\Resources\SuratSakits\Schemas\SuratSakitForm;

class SuratSakitResource extends Resource
{
    protected static ?string $model = SuratSakit::class;


    protected static ?string $pluralLabel = 'Surat Sakit';

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-document-text';
    }

    public static function form(Schema $schema): Schema
    {
        return SuratSakitForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('row_number')
                    ->label('No')
                    ->rowIndex(),
                TextColumn::make('nrp')->label('NRP')->searchable(),
                TextColumn::make('nama')->label('Nama')->searchable(),
                TextColumn::make('departemen')->label('Dept')->badge(),
                TextColumn::make('keluhan')->label('Keluhan')->limit(20),
                TextColumn::make('tanggal_surat')->label('Tanggal')->date('d/m/Y')->sortable(),
                TextColumn::make('petugas')->label('Petugas'),
                TextColumn::make('is_published')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn(bool $state) => $state ? 'Terbit' : 'Belum')
                    ->color(fn(bool $state) => $state ? 'success' : 'gray'),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('departemen')->searchable()->preload(),
                SelectFilter::make('petugas')->searchable()->preload(),
            ])
            ->actions([
                Action::make('terbitkan')
                    ->label('Terbitkan')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn(SuratSakit $record) => !$record->is_published)
                    ->requiresConfirmation()
                    ->modalHeading('Terbitkan Surat Sakit')
                    ->modalDescription(fn(SuratSakit $record) => "Terbitkan surat sakit untuk {$record->nama}?")
                    ->modalSubmitActionLabel('Ya, Terbitkan')
                    ->action(function (SuratSakit $record) {
                        $cetak = CetakSuratSakit::create([
                            'surat_sakit_id' => $record->id,
                            'short_code' => CetakSuratSakit::generateShortCode(),
                            'nama' => $record->nama,
                            'umur' => $record->umur,
                            'jabatan' => $record->jabatan,
                            'departemen' => $record->departemen,
                            'keluhan' => $record->keluhan,
                            'tanggal_surat' => $record->tanggal_surat,
                            'jam_keluar_surat' => $record->jam_keluar_surat,
                            'petugas' => $record->petugas,
                        ]);

                        $record->update(['is_published' => true]);

                        Notification::make()
                            ->title('Surat Berhasil Diterbitkan')
                            ->body('Kode: ' . $cetak->short_code)
                            ->success()
                            ->send();
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSuratSakits::route('/'),
            'view' => Pages\ViewSuratSakit::route('/{record}'),
        ];
    }
}
