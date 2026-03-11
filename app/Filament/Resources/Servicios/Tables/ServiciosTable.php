<?php

namespace App\Filament\Resources\Servicios\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

// 📁 Archivo: app/Filament/Resources/Servicios/Tables/ServiciosTable.php
// Tabla para listar servicios médicos

class ServiciosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('especialidad.nombre')
                    ->label('Especialidad')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),
                
                TextColumn::make('nombre')
                    ->label('Servicio')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn ($record) => $record->descripcion ? Str::limit($record->descripcion, 50) : null),
                
                TextColumn::make('precio')
                    ->label('Precio')
                    ->money('PEN')
                    ->sortable()
                    ->alignEnd()
                    ->badge()
                    ->color('success')
                    ->formatStateUsing(fn ($state) => 'S/ ' . number_format($state, 2)),
                
                TextColumn::make('duracion_minutos')
                    ->label('Duración')
                    ->numeric()
                    ->sortable()
                    ->suffix(' min')
                    ->alignCenter()
                    ->badge()
                    ->color('warning'),
                
                TextColumn::make('citas_count')
                    ->label('Citas')
                    ->counts('citas')
                    ->badge()
                    ->color('primary'),
                
                IconColumn::make('activo')
                    ->label('Activo')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('nombre', 'asc')
            ->filters([
                SelectFilter::make('especialidad_id')
                    ->label('Especialidad')
                    ->relationship('especialidad', 'nombre')
                    ->searchable()
                    ->preload(),
                
                TernaryFilter::make('activo')
                    ->label('Estado')
                    ->placeholder('Todos')
                    ->trueLabel('Solo activos')
                    ->falseLabel('Solo inactivos'),
            ])
            ->recordActions([
                ViewAction::make()
                    ->icon('heroicon-o-eye'),
                EditAction::make()
                    ->icon('heroicon-o-pencil'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->icon('heroicon-o-trash'),
                ]),
            ])
            ->emptyStateHeading('No hay servicios')
            ->emptyStateDescription('Crea tu primer servicio médico para comenzar.')
            ->emptyStateIcon('heroicon-o-clipboard-document-list');
    }
}
