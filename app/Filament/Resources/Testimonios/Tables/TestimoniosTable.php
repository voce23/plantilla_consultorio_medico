<?php

namespace App\Filament\Resources\Testimonios\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

// 📁 Archivo: app/Filament/Resources/Testimonios/Tables/TestimoniosTable.php
// Tabla para listar testimonios en el panel de administración

class TestimoniosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Foto del paciente
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(fn () => 'https://ui-avatars.com/api/?name=User&background=0ea5e9&color=fff')
                    ->size(40),

                // Nombre del paciente
                TextColumn::make('nombre')
                    ->label('Paciente')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                // Estrellas (calificación)
                TextColumn::make('estrellas')
                    ->label('Calificación')
                    ->formatStateUsing(fn ($state) => str_repeat('⭐', $state))
                    ->sortable(),

                // Servicio
                TextColumn::make('servicio')
                    ->label('Servicio')
                    ->searchable()
                    ->toggleable()
                    ->placeholder('No especificado'),

                // Comentario (truncado)
                TextColumn::make('comentario')
                    ->label('Testimonio')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->comentario)
                    ->toggleable(),

                // Toggle de aprobado
                ToggleColumn::make('aprobado')
                    ->label('Aprobado')
                    ->sortable(),

                // Toggle de destacado
                ToggleColumn::make('destacado')
                    ->label('Destacado')
                    ->sortable(),

                // Fecha de creación
                TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filtro por aprobado
                TernaryFilter::make('aprobado')
                    ->label('Estado de aprobación')
                    ->placeholder('Todos')
                    ->trueLabel('Aprobados')
                    ->falseLabel('Pendientes'),

                // Filtro por destacado
                TernaryFilter::make('destacado')
                    ->label('Destacados')
                    ->placeholder('Todos')
                    ->trueLabel('Solo destacados')
                    ->falseLabel('No destacados'),
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
            ->emptyStateHeading('No hay testimonios')
            ->emptyStateDescription('Los testimonios de pacientes aparecerán aquí.')
            ->emptyStateIcon('heroicon-o-chat-bubble-left-right');
    }
}
