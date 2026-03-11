<?php

namespace App\Filament\Resources\Articulos;

use App\Filament\Resources\Articulos\Pages\CreateArticulo;
use App\Filament\Resources\Articulos\Pages\EditArticulo;
use App\Filament\Resources\Articulos\Pages\ListArticulos;
use App\Filament\Resources\Articulos\Schemas\ArticuloForm;
use App\Filament\Resources\Articulos\Tables\ArticulosTable;
use App\Models\Articulo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

// 📁 Archivo: app/Filament/Resources/Articulos/ArticuloResource.php
// Resource para gestionar artículos del blog

class ArticuloResource extends Resource
{
    protected static ?string $model = Articulo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $recordTitleAttribute = 'titulo';

    protected static ?string $modelLabel = 'artículo';

    protected static ?string $pluralModelLabel = 'artículos';

    protected static string|UnitEnum|null $navigationGroup = 'Blog de Salud';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return ArticuloForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ArticulosTable::configure($table);
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
            'index' => ListArticulos::route('/'),
            'create' => CreateArticulo::route('/create'),
            'edit' => EditArticulo::route('/{record}/edit'),
        ];
    }
}
