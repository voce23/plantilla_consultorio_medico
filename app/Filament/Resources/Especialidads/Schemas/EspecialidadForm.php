<?php

namespace App\Filament\Resources\Especialidads\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

// 📁 Archivo: app/Filament/Resources/Especialidads/Schemas/EspecialidadForm.php
// Formulario para crear/editar especialidades médicas

class EspecialidadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información de la Especialidad')
                    ->description('Datos principales de la especialidad médica')
                    ->icon('heroicon-o-heart')
                    ->schema([
                        TextInput::make('nombre')
                            ->label('Nombre de la especialidad')
                            ->placeholder('Ej: Cardiología, Dermatología, Pediatría')
                            ->required()
                            ->maxLength(100)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $context, $state, callable $set) => 
                                $context === 'create' ? $set('slug', Str::slug($state)) : null
                            ),
                        
                        TextInput::make('slug')
                            ->label('URL Slug')
                            ->placeholder('se-genera-automaticamente')
                            ->required()
                            ->maxLength(120)
                            ->unique(ignoreRecord: true)
                            ->helperText('Se genera automáticamente desde el nombre'),
                        
                        Textarea::make('descripcion')
                            ->label('Descripción')
                            ->placeholder('Describe brevemente esta especialidad médica...')
                            ->rows(3)
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Configuración')
                    ->description('Opciones de visualización')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        Select::make('icono')
                            ->label('Icono médico')
                            ->options([
                                'corazon' => '❤️ Corazón (Cardiología)',
                                'pulmon' => '🫁 Pulmón (Neumología)',
                                'cerebro' => '🧠 Cerebro (Neurología)',
                                'ojo' => '👁️ Ojo (Oftalmología)',
                                'hueso' => '🦴 Hueso (Traumatología)',
                                'piel' => '🩹 Piel (Dermatología)',
                                'bebe' => '👶 Bebé (Pediatría)',
                                'mujer' => '👩 Mujer (Ginecología)',
                                'diente' => '🦷 Diente (Odontología)',
                                'estetoscopio' => '🩺 Estetoscopio (General)',
                            ])
                            ->searchable()
                            ->default('estetoscopio'),
                        
                        Toggle::make('activo')
                            ->label('Especialidad activa')
                            ->helperText('Las especialidades inactivas no se muestran en la web')
                            ->default(true)
                            ->onColor('success')
                            ->offColor('danger'),
                    ])
                    ->columns(2),
            ]);
    }
}
