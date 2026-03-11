<?php

namespace App\Filament\Resources\Citas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

// 📁 Archivo: app/Filament/Resources/Citas/Tables/CitasTable.php
// Tabla para listar citas en el panel de administración

class CitasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // ID de la cita
                TextColumn::make('id')
                    ->label('N° Cita')
                    ->sortable()
                    ->searchable()
                    ->weight('bold'),

                // Paciente
                TextColumn::make('paciente.nombre_completo')
                    ->label('Paciente')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => $record->paciente?->telefono)
                    ->icon('heroicon-o-user'),

                // Doctor
                TextColumn::make('doctor.nombre_completo')
                    ->label('Doctor')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-user-circle'),

                // Especialidad
                TextColumn::make('especialidad.nombre')
                    ->label('Especialidad')
                    ->badge()
                    ->color('info')
                    ->searchable(),

                // Fecha y Hora
                TextColumn::make('fecha')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable()
                    ->icon('heroicon-o-calendar'),

                TextColumn::make('hora')
                    ->label('Hora')
                    ->time('H:i')
                    ->sortable()
                    ->icon('heroicon-o-clock'),

                // Estado con colores
                BadgeColumn::make('estado')
                    ->label('Estado')
                    ->colors([
                        'warning' => 'pendiente',
                        'success' => 'confirmada',
                        'primary' => 'completada',
                        'danger' => 'cancelada',
                    ])
                    ->icons([
                        'heroicon-o-clock' => 'pendiente',
                        'heroicon-o-check-circle' => 'confirmada',
                        'heroicon-o-clipboard-document-check' => 'completada',
                        'heroicon-o-x-circle' => 'cancelada',
                    ])
                    ->sortable(),

                // Costo
                TextColumn::make('costo')
                    ->label('Costo')
                    ->money('PEN')
                    ->sortable()
                    ->toggleable()
                    ->formatStateUsing(fn ($state) => $state ? 'S/ ' . number_format($state, 2) : '-'),

                // Fecha de creación
                TextColumn::make('created_at')
                    ->label('Registrada')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filtro por estado
                SelectFilter::make('estado')
                    ->label('Estado')
                    ->options([
                        'pendiente' => '⏳ Pendiente',
                        'confirmada' => '✅ Confirmada',
                        'completada' => '🏥 Completada',
                        'cancelada' => '❌ Cancelada',
                    ])
                    ->placeholder('Todos los estados'),

                // Filtro por doctor
                SelectFilter::make('doctor_id')
                    ->label('Doctor')
                    ->relationship('doctor', 'nombre_completo')
                    ->searchable()
                    ->preload()
                    ->placeholder('Todos los doctores'),

                // Filtro por especialidad
                SelectFilter::make('especialidad_id')
                    ->label('Especialidad')
                    ->relationship('especialidad', 'nombre')
                    ->searchable()
                    ->preload()
                    ->placeholder('Todas las especialidades'),

                // Filtro por fecha
                Filter::make('fecha')
                    ->label('Fecha')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('desde')
                            ->label('Desde'),
                        \Filament\Forms\Components\DatePicker::make('hasta')
                            ->label('Hasta'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['desde'],
                                fn (Builder $query, $date): Builder => $query->whereDate('fecha', '>=', $date),
                            )
                            ->when(
                                $data['hasta'],
                                fn (Builder $query, $date): Builder => $query->whereDate('fecha', '<=', $date),
                            );
                    }),
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
            ->defaultSort('fecha', 'desc')
            ->emptyStateHeading('No hay citas registradas')
            ->emptyStateDescription('Crea una nueva cita para comenzar.')
            ->emptyStateIcon('heroicon-o-calendar');
    }
}
