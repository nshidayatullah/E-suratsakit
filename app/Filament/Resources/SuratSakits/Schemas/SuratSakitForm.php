<?php

namespace App\Filament\Resources\SuratSakits\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;

class SuratSakitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nrp')->label('NRP'),
                TextInput::make('nama')->label('Nama'),
                TextInput::make('umur')->label('Umur'),
                TextInput::make('jabatan')->label('Jabatan'),
                TextInput::make('departemen')->label('Departemen'),
                Textarea::make('keluhan')->label('Keluhan'),
                TextInput::make('jam_keluar_surat')->label('Jam'),
                DatePicker::make('tanggal_surat')->label('Tanggal'),
                TextInput::make('petugas')->label('Petugas'),
            ]);
    }
}
