<?php

namespace App\Filament\Resources\Articulos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

// 📁 Archivo: app/Filament/Resources/Articulos/Tables/ArticulosTable.php
// Tabla para listar artículos en el panel de administración

class ArticulosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Imagen destacada
                ImageColumn::make('imagen_destacada')
                    ->label('Imagen')
                    ->square()
                    ->defaultImageUrl(fn () => 'https://placehold.co/100x100/e2e8f0/64748b?text=Sin+Imagen')
                    ->size(60),

                // Título
                TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->limit(50)
                    ->weight('bold'),

                // Categoría con color
                TextColumn::make('categoria.nombre')
                    ->label('Categoría')
                    ->badge()
                    ->color(fn ($record) => $record->categoria?->color ?? 'gray')
                    ->sortable(),

                // Visitas
                TextColumn::make('visitas')
                    ->label('Visitas')
                    ->numeric()
                    ->sortable()
                    ->icon('heroicon-o-eye')
                    ->color('success'),

                // Estado de publicación
                ToggleColumn::make('publicado')
                    ->label('Publicado')
                    ->sortable(),

                // Fecha de publicación
                TextColumn::make('fecha_publicacion')
                    ->label('Fecha')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(),

                // Tiempo de lectura
                TextColumn::make('tiempo_lectura')
                    ->label('Lectura')
                    ->formatStateUsing(fn ($state) => $state . ' min')
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filtro por categoría
                SelectFilter::make('categoria')
                    ->label('Categoría')
                    ->relationship('categoria', 'nombre')
                    ->searchable()
                    ->preload(),

                // Filtro por estado
                TernaryFilter::make('publicado')
                    ->label('Estado')
                    ->placeholder('Todos')
                    ->trueLabel('Publicados')
                    ->falseLabel('Borradores'),
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
            ->defaultSort('fecha_publicacion', 'desc')
            ->emptyStateHeading('No hay artículos')
            ->emptyStateDescription('Los artículos del blog aparecerán aquí.')
            ->emptyStateIcon('heroicon-o-document-text');
    }
}
