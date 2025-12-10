<?php

namespace App\Filament\Resources\SuratSakitTercetaks;

use App\Filament\Resources\SuratSakitTercetaks\Pages\CreateSuratSakitTercetak;
use App\Filament\Resources\SuratSakitTercetaks\Pages\EditSuratSakitTercetak;
use App\Filament\Resources\SuratSakitTercetaks\Pages\ListSuratSakitTercetaks;
use App\Filament\Resources\SuratSakitTercetaks\Pages\ViewSuratSakitTercetak;
use App\Filament\Resources\SuratSakitTercetaks\Schemas\SuratSakitTercetakForm;
use App\Filament\Resources\SuratSakitTercetaks\Schemas\SuratSakitTercetakInfolist;
use App\Filament\Resources\SuratSakitTercetaks\Tables\SuratSakitTercetaksTable;
use App\Models\SuratSakitTercetak;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuratSakitTercetakResource extends Resource
{
    protected static ?string $model = SuratSakitTercetak::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Surat Terbit';

    protected static ?string $pluralLabel = 'Surat Terbit';

    protected static ?string $recordTitleAttribute = 'Surat Sakit Tercetak';

    public static function form(Schema $schema): Schema
    {
        return SuratSakitTercetakForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SuratSakitTercetakInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SuratSakitTercetaksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSuratSakitTercetaks::route('/'),
            'create' => CreateSuratSakitTercetak::route('/create'),
            'view' => ViewSuratSakitTercetak::route('/{record}'),
            'edit' => EditSuratSakitTercetak::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
