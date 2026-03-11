<?php

namespace App\Filament\Resources\Especialidads\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

// 📁 Archivo: app/Filament/Resources/Especialidads/Tables/EspecialidadsTable.php
// Tabla para listar especialidades médicas

class EspecialidadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')
                    ->label('Especialidad')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->color('primary'),
                
                TextColumn::make('slug')
                    ->label('URL Slug')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Slug copiado')
                    ->color('gray'),
                
                TextColumn::make('icono')
                    ->label('Icono')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'corazon' => '❤️ Corazón',
                        'pulmon' => '🫁 Pulmón',
                        'cerebro' => '🧠 Cerebro',
                        'ojo' => '👁️ Ojo',
                        'hueso' => '🦴 Hueso',
                        'piel' => '🩹 Piel',
                        'bebe' => '👶 Bebé',
                        'mujer' => '👩 Mujer',
                        'diente' => '🦷 Diente',
                        default => '🩺 General',
                    }),
                
                TextColumn::make('doctors_count')
                    ->label('Doctores')
                    ->counts('doctors')
                    ->badge()
                    ->color('success'),
                
                TextColumn::make('servicios_count')
                    ->label('Servicios')
                    ->counts('servicios')
                    ->badge()
                    ->color('info'),
                
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
                TernaryFilter::make('activo')
                    ->label('Estado')
                    ->placeholder('Todas')
                    ->trueLabel('Solo activas')
                    ->falseLabel('Solo inactivas'),
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
            ->emptyStateHeading('No hay especialidades')
            ->emptyStateDescription('Crea tu primera especialidad médica para comenzar.')
            ->emptyStateIcon('heroicon-o-heart');
    }
}
