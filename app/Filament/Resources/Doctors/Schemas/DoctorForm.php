<?php

namespace App\Filament\Resources\Doctors\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

// 📁 Archivo: app/Filament/Resources/Doctors/Schemas/DoctorForm.php
// Formulario para crear y editar doctores

class DoctorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Sección: Información Personal
                Section::make('Información Personal')
                    ->description('Datos básicos del médico')
                    ->icon('heroicon-o-user')
                    ->schema([
                        TextInput::make('nombre')
                            ->label('Nombre')
                            ->placeholder('Ej: Juan')
                            ->required()
                            ->maxLength(100)
                            ->columnSpan(1),
                        TextInput::make('apellido')
                            ->label('Apellido')
                            ->placeholder('Ej: Pérez García')
                            ->required()
                            ->maxLength(100)
                            ->columnSpan(1),
                        TextInput::make('dni')
                            ->label('DNI')
                            ->placeholder('Ej: 12345678')
                            ->maxLength(8)
                            ->unique(ignoreRecord: true)
                            ->columnSpan(1),
                        TextInput::make('cmp')
                            ->label('CMP (Colegio Médico)')
                            ->placeholder('Ej: 12345')
                            ->maxLength(10)
                            ->unique(ignoreRecord: true)
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->collapsible(),

                // Sección: Contacto
                Section::make('Contacto')
                    ->description('Información de contacto')
                    ->icon('heroicon-o-phone')
                    ->schema([
                        TextInput::make('email')
                            ->label('Correo Electrónico')
                            ->placeholder('doctor@clinica.com')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->columnSpan(1),
                        TextInput::make('telefono')
                            ->label('Teléfono')
                            ->placeholder('+51 999 999 999')
                            ->tel()
                            ->maxLength(20)
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->collapsible(),

                // Sección: Profesional
                Section::make('Información Profesional')
                    ->description('Especialidad y biografía')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        Select::make('especialidad_id')
                            ->label('Especialidad')
                            ->relationship('especialidad', 'nombre')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->placeholder('Selecciona una especialidad')
                            ->columnSpan(2),
                        Textarea::make('biografia')
                            ->label('Biografía')
                            ->placeholder('Escribe una breve biografía del médico...')
                            ->rows(4)
                            ->maxLength(1000)
                            ->columnSpanFull()
                            ->helperText('Máximo 1000 caracteres'),
                    ])
                    ->columns(2)
                    ->collapsible(),

                // Sección: Foto y Estado
                Section::make('Foto y Estado')
                    ->description('Imagen de perfil y disponibilidad')
                    ->icon('heroicon-o-camera')
                    ->schema([
                        FileUpload::make('foto')
                            ->label('Foto de Perfil')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '1:1',
                            ])
                            ->directory('doctores/fotos')
                            ->maxSize(2048)
                            ->helperText('Imagen cuadrada, máximo 2MB')
                            ->columnSpan(1),
                        Toggle::make('activo')
                            ->label('Doctor Activo')
                            ->helperText('Los doctores inactivos no aparecen en la página pública')
                            ->default(true)
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->collapsible(),

                // Sección: Usuario del Sistema
                Section::make('Usuario del Sistema')
                    ->description('Cuenta de usuario asociada')
                    ->icon('heroicon-o-key')
                    ->schema([
                        Select::make('user_id')
                            ->label('Usuario')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->placeholder('Selecciona un usuario (opcional)')
                            ->helperText('Asocia este doctor con una cuenta de usuario del sistema'),
                    ])
                    ->collapsed()
                    ->collapsible(),
            ]);
    }
}
