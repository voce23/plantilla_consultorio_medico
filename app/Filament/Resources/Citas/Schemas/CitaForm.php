<?php

namespace App\Filament\Resources\Citas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

// 📁 Archivo: app/Filament/Resources/Citas/Schemas/CitaForm.php
// Formulario para crear y editar citas médicas

class CitaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Sección: Información del Paciente
                Section::make('Información del Paciente')
                    ->description('Datos del paciente que solicita la cita')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Select::make('paciente_id')
                            ->label('Paciente')
                            ->relationship('paciente', 'nombre_completo')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->placeholder('Selecciona un paciente')
                            ->columnSpan(2),
                    ])
                    ->columns(2)
                    ->collapsible(),

                // Sección: Detalles de la Cita
                Section::make('Detalles de la Cita')
                    ->description('Doctor, especialidad y servicio')
                    ->icon('heroicon-o-stethoscope')
                    ->schema([
                        Select::make('doctor_id')
                            ->label('Doctor')
                            ->relationship('doctor', 'nombre_completo', fn ($query) => $query->where('activo', true))
                            ->searchable()
                            ->preload()
                            ->required()
                            ->placeholder('Selecciona un doctor')
                            ->live()
                            ->afterStateUpdated(function (callable $set) {
                                $set('especialidad_id', null);
                                $set('servicio_id', null);
                            })
                            ->columnSpan(1),

                        Select::make('especialidad_id')
                            ->label('Especialidad')
                            ->relationship('especialidad', 'nombre')
                            ->searchable()
                            ->preload()
                            ->placeholder('Selecciona especialidad')
                            ->columnSpan(1),

                        Select::make('servicio_id')
                            ->label('Servicio')
                            ->relationship('servicio', 'nombre', fn ($query) => $query->where('activo', true))
                            ->searchable()
                            ->preload()
                            ->placeholder('Selecciona un servicio')
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $servicio = \App\Models\Servicio::find($state);
                                    if ($servicio) {
                                        $set('costo', $servicio->precio);
                                    }
                                }
                            })
                            ->columnSpan(2),
                    ])
                    ->columns(2)
                    ->collapsible(),

                // Sección: Fecha y Hora
                Section::make('Fecha y Hora')
                    ->description('Programación de la cita')
                    ->icon('heroicon-o-calendar')
                    ->schema([
                        DatePicker::make('fecha')
                            ->label('Fecha de la Cita')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->minDate(now())
                            ->placeholder('Selecciona una fecha')
                            ->columnSpan(1),

                        TimePicker::make('hora')
                            ->label('Hora de la Cita')
                            ->required()
                            ->native(false)
                            ->displayFormat('H:i')
                            ->placeholder('Selecciona una hora')
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->collapsible(),

                // Sección: Estado y Costo
                Section::make('Estado y Costo')
                    ->description('Información administrativa')
                    ->icon('heroicon-o-currency-dollar')
                    ->schema([
                        Select::make('estado')
                            ->label('Estado de la Cita')
                            ->options([
                                'pendiente' => '⏳ Pendiente',
                                'confirmada' => '✅ Confirmada',
                                'completada' => '🏥 Completada',
                                'cancelada' => '❌ Cancelada',
                            ])
                            ->default('pendiente')
                            ->required()
                            ->columnSpan(1),

                        TextInput::make('costo')
                            ->label('Costo (S/)')
                            ->numeric()
                            ->prefix('S/')
                            ->placeholder('0.00')
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->collapsible(),

                // Sección: Motivo y Notas
                Section::make('Motivo y Notas')
                    ->description('Información adicional')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Textarea::make('motivo')
                            ->label('Motivo de la Consulta')
                            ->placeholder('Describe el motivo de la cita...')
                            ->rows(3)
                            ->maxLength(500)
                            ->helperText('Máximo 500 caracteres')
                            ->columnSpanFull(),

                        Textarea::make('notas')
                            ->label('Notas Adicionales')
                            ->placeholder('Notas internas sobre la cita...')
                            ->rows(2)
                            ->maxLength(500)
                            ->helperText('Estas notas son solo para uso interno')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }
}
