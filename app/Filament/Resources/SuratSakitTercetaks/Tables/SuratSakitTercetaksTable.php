<?php

namespace App\Filament\Resources\SuratSakitTercetaks\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Tables\Filters\SelectFilter;

class SuratSakitTercetaksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('short_code')
                    ->label('Kode')
                    ->badge()
                    ->color('success')
                    ->copyable()
                    ->searchable(),
                TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('departemen')
                    ->label('Dept')
                    ->badge(),
                TextColumn::make('keluhan')
                    ->label('Keluhan')
                    ->limit(20),
                TextColumn::make('tanggal_surat')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('petugas')
                    ->label('Petugas')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Dicetak')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('departemen')->searchable()->preload(),
                SelectFilter::make('petugas')->searchable()->preload(),
            ])
            ->actions([
            Action::make('preview')
                ->label('Preview')
                ->icon('heroicon-o-eye')
                ->color('info')
                ->url(fn($record) => route('surat.cetak', $record->short_code))
                ->openUrlInNewTab(),
                // Action::make('download')
                //     ->label('Download')
                //     ->icon('heroicon-o-arrow-down-tray')
                //     ->color('success')
                //     ->url(fn($record) => route('surat.download', $record->short_code))
                //     ->openUrlInNewTab(),
                DeleteAction::make(),
            ]);
    }
}
