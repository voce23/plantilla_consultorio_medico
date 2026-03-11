<?php

namespace App\Filament\Resources\Servicios\Schemas;

use App\Models\Especialidad;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

// 📁 Archivo: app/Filament/Resources/Servicios/Schemas/ServicioForm.php
// Formulario para crear/editar servicios médicos

class ServicioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información del Servicio')
                    ->description('Datos principales del servicio médico')
                    ->icon('heroicon-o-clipboard-document-list')
                    ->schema([
                        Select::make('especialidad_id')
                            ->label('Especialidad')
                            ->relationship('especialidad', 'nombre')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->placeholder('Selecciona una especialidad')
                            ->createOptionForm([
                                TextInput::make('nombre')
                                    ->required()
                                    ->maxLength(100),
                                TextInput::make('slug')
                                    ->required()
                                    ->maxLength(120),
                            ])
                            ->createOptionUsing(function (array $data): int {
                                $data['activo'] = true;
                                $data['icono'] = 'estetoscopio';
                                return Especialidad::create($data)->id;
                            }),
                        
                        TextInput::make('nombre')
                            ->label('Nombre del servicio')
                            ->placeholder('Ej: Consulta general, Ecografía, Análisis de sangre')
                            ->required()
                            ->maxLength(150)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $context, $state, callable $set) => 
                                $context === 'create' ? $set('slug', Str::slug($state)) : null
                            ),
                        
                        TextInput::make('slug')
                            ->label('URL Slug')
                            ->required()
                            ->maxLength(170)
                            ->unique(ignoreRecord: true)
                            ->helperText('Se genera automáticamente desde el nombre'),
                        
                        Textarea::make('descripcion')
                            ->label('Descripción')
                            ->placeholder('Describe el servicio médico que se ofrece...')
                            ->rows(3)
                            ->maxLength(1000)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Precios y Duración')
                    ->description('Configuración de costos y tiempos')
                    ->icon('heroicon-o-currency-dollar')
                    ->schema([
                        TextInput::make('precio')
                            ->label('Precio (S/)')
                            ->numeric()
                            ->prefix('S/')
                            ->minValue(0)
                            ->maxValue(9999.99)
                            ->step(0.01)
                            ->default(0.00)
                            ->helperText('Precio en Soles peruanos'),
                        
                        TextInput::make('duracion_minutos')
                            ->label('Duración (minutos)')
                            ->numeric()
                            ->minValue(5)
                            ->maxValue(480)
                            ->default(30)
                            ->suffix('min')
                            ->helperText('Tiempo estimado de la consulta'),
                    ])
                    ->columns(2),

                Section::make('Estado')
                    ->description('Visibilidad en la web')
                    ->icon('heroicon-o-eye')
                    ->schema([
                        Toggle::make('activo')
                            ->label('Servicio activo')
                            ->helperText('Los servicios inactivos no se muestran en la web')
                            ->default(true)
                            ->onColor('success')
                            ->offColor('danger'),
                    ]),
            ]);
    }
}
