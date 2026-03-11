<?php

namespace App\Filament\Resources\Doctors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

// 📁 Archivo: app/Filament/Resources/Doctors/Tables/DoctorsTable.php
// Tabla para listar doctores en el panel de administración

class DoctorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Foto del doctor
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(fn () => 'https://ui-avatars.com/api/?name=Doctor&background=0ea5e9&color=fff&size=40')
                    ->size(40),

                // Nombre completo
                TextColumn::make('nombre_completo')
                    ->label('Nombre Completo')
                    ->searchable(['nombre', 'apellido'])
                    ->sortable()
                    ->weight('bold')
                    ->description(fn ($record) => $record->email),

                // Especialidad
                TextColumn::make('especialidad.nombre')
                    ->label('Especialidad')
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->sortable(),

                // CMP
                TextColumn::make('cmp')
                    ->label('CMP')
                    ->searchable()
                    ->badge()
                    ->color('gray')
                    ->toggleable(),

                // Teléfono
                TextColumn::make('telefono')
                    ->label('Teléfono')
                    ->searchable()
                    ->icon('heroicon-o-phone')
                    ->toggleable(isToggledHiddenByDefault: true),

                // Email
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->icon('heroicon-o-envelope')
                    ->toggleable(),

                // Estado activo
                IconColumn::make('activo')
                    ->label('Activo')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),

                // Fecha de creación
                TextColumn::make('created_at')
                    ->label('Registrado')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filtro por especialidad
                SelectFilter::make('especialidad_id')
                    ->label('Especialidad')
                    ->relationship('especialidad', 'nombre')
                    ->searchable()
                    ->preload()
                    ->placeholder('Todas las especialidades'),

                // Filtro por estado activo
                TernaryFilter::make('activo')
                    ->label('Estado')
                    ->placeholder('Todos')
                    ->trueLabel('Solo activos')
                    ->falseLabel('Solo inactivos'),
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
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('No hay doctores registrados')
            ->emptyStateDescription('Crea un nuevo doctor para comenzar.')
            ->emptyStateIcon('heroicon-o-user');
    }
}
