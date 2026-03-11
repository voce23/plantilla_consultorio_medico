<?php

namespace App\Filament\Resources\Testimonios;

use App\Filament\Resources\Testimonios\Pages\CreateTestimonio;
use App\Filament\Resources\Testimonios\Pages\EditTestimonio;
use App\Filament\Resources\Testimonios\Pages\ListTestimonios;
use App\Filament\Resources\Testimonios\Schemas\TestimonioForm;
use App\Filament\Resources\Testimonios\Tables\TestimoniosTable;
use App\Models\Testimonio;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

// 📁 Archivo: app/Filament/Resources/Testimonios/TestimonioResource.php
// Resource para gestionar testimonios de pacientes

class TestimonioResource extends Resource
{
    protected static ?string $model = Testimonio::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

    protected static ?string $recordTitleAttribute = 'nombre';

    protected static ?string $modelLabel = 'testimonio';

    protected static ?string $pluralModelLabel = 'testimonios';

    protected static string|UnitEnum|null $navigationGroup = 'Contenido Web';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return TestimonioForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TestimoniosTable::configure($table);
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
            'index' => ListTestimonios::route('/'),
            'create' => CreateTestimonio::route('/create'),
            'edit' => EditTestimonio::route('/{record}/edit'),
        ];
    }
}
