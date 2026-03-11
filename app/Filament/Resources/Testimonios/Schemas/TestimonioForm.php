<?php

namespace App\Filament\Resources\Testimonios\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

// 📁 Archivo: app/Filament/Resources/Testimonios/Schemas/TestimonioForm.php
// Formulario para crear y editar testimonios

class TestimonioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Sección: Información del Paciente
                Section::make('Información del Paciente')
                    ->description('Datos de quien deja el testimonio')
                    ->icon('heroicon-o-user')
                    ->schema([
                        TextInput::make('nombre')
                            ->label('Nombre completo')
                            ->placeholder('Ej: María García')
                            ->required()
                            ->maxLength(100)
                            ->columnSpan(2),

                        FileUpload::make('foto')
                            ->label('Foto de perfil')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios(['1:1'])
                            ->directory('testimonios/fotos')
                            ->maxSize(1024)
                            ->helperText('Imagen cuadrada, máximo 1MB')
                            ->columnSpan(1),
                    ])
                    ->columns(3)
                    ->collapsible(),

                // Sección: Valoración
                Section::make('Valoración')
                    ->description('Calificación y detalles del servicio')
                    ->icon('heroicon-o-star')
                    ->schema([
                        Select::make('estrellas')
                            ->label('Calificación')
                            ->options([
                                1 => '⭐ 1 estrella',
                                2 => '⭐⭐ 2 estrellas',
                                3 => '⭐⭐⭐ 3 estrellas',
                                4 => '⭐⭐⭐⭐ 4 estrellas',
                                5 => '⭐⭐⭐⭐⭐ 5 estrellas',
                            ])
                            ->default(5)
                            ->required()
                            ->columnSpan(1),

                        TextInput::make('servicio')
                            ->label('Servicio recibido')
                            ->placeholder('Ej: Consulta de Cardiología')
                            ->maxLength(100)
                            ->columnSpan(2),
                    ])
                    ->columns(3)
                    ->collapsible(),

                // Sección: Testimonio
                Section::make('Testimonio')
                    ->description('El comentario del paciente')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->schema([
                        Textarea::make('comentario')
                            ->label('Comentario')
                            ->placeholder('Escribe el testimonio del paciente...')
                            ->required()
                            ->rows(4)
                            ->maxLength(1000)
                            ->helperText('Máximo 1000 caracteres')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                // Sección: Publicación
                Section::make('Publicación')
                    ->description('Configuración de visibilidad')
                    ->icon('heroicon-o-eye')
                    ->schema([
                        Toggle::make('aprobado')
                            ->label('Aprobado para publicar')
                            ->helperText('Solo los testimonios aprobados aparecen en la web')
                            ->default(false)
                            ->columnSpan(1),

                        Toggle::make('destacado')
                            ->label('Destacar testimonio')
                            ->helperText('Los testimonios destacados aparecen primero')
                            ->default(false)
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }
}
