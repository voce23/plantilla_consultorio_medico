<?php

namespace App\Filament\Resources\Categorias\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

// 📁 Archivo: app/Filament/Resources/Categorias/Schemas/CategoriaForm.php
// Formulario para crear y editar categorías

class CategoriaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información de la Categoría')
                    ->description('Datos básicos de la categoría')
                    ->icon('heroicon-o-folder')
                    ->schema([
                        TextInput::make('nombre')
                            ->label('Nombre')
                            ->placeholder('Ej: Nutrición')
                            ->required()
                            ->maxLength(100)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (callable $set, $state) {
                                $set('slug', Str::slug($state));
                            }),

                        TextInput::make('slug')
                            ->label('Slug (URL)')
                            ->placeholder('Ej: nutricion')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(100)
                            ->helperText('Identificador único para la URL. Se genera automáticamente.'),
                    ])
                    ->columns(2),

                Section::make('Apariencia')
                    ->description('Personalización visual')
                    ->icon('heroicon-o-paint-brush')
                    ->schema([
                        ColorPicker::make('color')
                            ->label('Color de la categoría')
                            ->default('#0ea5e9')
                            ->helperText('Este color se usará para identificar la categoría en el blog.'),
                    ]),

                Section::make('Descripción')
                    ->description('Información adicional')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Textarea::make('descripcion')
                            ->label('Descripción')
                            ->placeholder('Describe brevemente de qué trata esta categoría...')
                            ->rows(3)
                            ->maxLength(500)
                            ->helperText('Aparecerá en la página de la categoría. Máximo 500 caracteres.'),
                    ]),
            ]);
    }
}
