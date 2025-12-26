<?php

namespace App\Filament\Resources\SuratSakitTercetaks\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;

class SuratSakitTercetakForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('short_code')
                    ->label('Kode')
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('nama')
                    ->label('Nama')
                    ->required(),
                TextInput::make('umur')
                    ->label('Umur')
                    ->numeric()
                    ->suffix('Tahun'),
                TextInput::make('jabatan')
                    ->label('Jabatan'),
                TextInput::make('departemen')
                    ->label('Departemen'),
                Textarea::make('keluhan')
                    ->label('Keluhan')
                    ->rows(3),
                DatePicker::make('tanggal_surat')
                    ->label('Tanggal Surat')
                    ->required(),
                TimePicker::make('jam_keluar_surat')
                    ->label('Jam Keluar Surat')
                    ->seconds(false)
                    ->required(),
                TextInput::make('petugas')
                    ->label('Petugas')
                    ->required(),
            ]);
    }
}
