<?php

namespace App\Filament\Resources\SuratSakitTercetaks\Tables;

use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;

class SuratSakitTercetaksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('row_number')
                    ->label('No')
                    ->rowIndex(),
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
                TextColumn::make('short_code')
                    ->label('Kode')
                    ->size('lg')
                    ->color('success')
                    ->copyable()
                    ->searchable(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('departemen')
                    ->options(fn() => \App\Models\CetakSuratSakit::query()
                        ->distinct()
                        ->whereNotNull('departemen')
                        ->pluck('departemen', 'departemen')
                        ->toArray())
                    ->searchable()
                    ->preload(),
                SelectFilter::make('petugas')
                    ->options(fn() => \App\Models\CetakSuratSakit::query()
                        ->distinct()
                        ->whereNotNull('petugas')
                        ->pluck('petugas', 'petugas')
                        ->toArray())
                    ->searchable()
                    ->preload(),
                Filter::make('tanggal_surat')
                    ->form([
                        DatePicker::make('dari')
                            ->label('Dari Tanggal'),
                        DatePicker::make('sampai')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['dari'], fn($q) => $q->whereDate('tanggal_surat', '>=', $data['dari']))
                            ->when($data['sampai'], fn($q) => $q->whereDate('tanggal_surat', '<=', $data['sampai']));
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['dari'] ?? null) {
                            $indicators['dari'] = 'Dari: ' . \Carbon\Carbon::parse($data['dari'])->format('d/m/Y');
                        }
                        if ($data['sampai'] ?? null) {
                            $indicators['sampai'] = 'Sampai: ' . \Carbon\Carbon::parse($data['sampai'])->format('d/m/Y');
                        }
                        return $indicators;
                    }),
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('preview')
                        ->label('Download PDF')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('success')
                        ->url(fn($record) => route('surat.download', $record->short_code))
                        ->openUrlInNewTab(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
                    ->icon('heroicon-o-ellipsis-vertical')
                    ->tooltip('Aksi'),
            ]);
    }
}
