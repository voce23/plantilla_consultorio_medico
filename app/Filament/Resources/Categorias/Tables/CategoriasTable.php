<?php

namespace App\Filament\Resources\Categorias\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

// 📁 Archivo: app/Filament/Resources/Categorias/Tables/CategoriasTable.php
// Tabla para listar categorías en el panel de administración

class CategoriasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Color de la categoría
                ColorColumn::make('color')
                    ->label('Color')
                    ->copyable(),

                // Nombre
                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                // Slug
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->color('gray')
                    ->copyable(),

                // Cantidad de artículos
                TextColumn::make('articulos_count')
                    ->label('Artículos')
                    ->counts('articulos')
                    ->sortable()
                    ->badge()
                    ->color('info'),

                // Descripción (truncada)
                TextColumn::make('descripcion')
                    ->label('Descripción')
                    ->limit(50)
                    ->toggleable()
                    ->placeholder('Sin descripción'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->icon('heroicon-o-pencil'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->icon('heroicon-o-trash'),
                ]),
            ])
            ->defaultSort('nombre', 'asc')
            ->emptyStateHeading('No hay categorías')
            ->emptyStateDescription('Las categorías del blog aparecerán aquí.')
            ->emptyStateIcon('heroicon-o-folder');
    }
}
