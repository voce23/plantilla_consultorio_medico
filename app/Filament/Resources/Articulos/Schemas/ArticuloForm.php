<?php

namespace App\Filament\Resources\Articulos\Schemas;

use App\Models\Categoria;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

// 📁 Archivo: app/Filament/Resources/Articulos/Schemas/ArticuloForm.php
// Formulario para crear y editar artículos del blog

class ArticuloForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Sección: Información Principal
                Section::make('Información Principal')
                    ->description('Datos básicos del artículo')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        TextInput::make('titulo')
                            ->label('Título')
                            ->placeholder('Ej: 5 consejos para una alimentación saludable')
                            ->required()
                            ->maxLength(200)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (callable $set, $state) {
                                $set('slug', Str::slug($state));
                            })
                            ->columnSpanFull(),

                        TextInput::make('slug')
                            ->label('Slug (URL)')
                            ->placeholder('Ej: 5-consejos-alimentacion-saludable')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(200)
                            ->helperText('Se genera automáticamente desde el título.')
                            ->columnSpanFull(),

                        Select::make('categoria_id')
                            ->label('Categoría')
                            ->relationship('categoria', 'nombre')
                            ->options(Categoria::ordenadas()->pluck('nombre', 'id'))
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                TextInput::make('nombre')
                                    ->required()
                                    ->maxLength(100),
                            ])
                            ->columnSpan(1),

                        FileUpload::make('imagen_destacada')
                            ->label('Imagen Destacada')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('blog/imagenes')
                            ->maxSize(2048)
                            ->helperText('Imagen principal del artículo. Máximo 2MB.')
                            ->columnSpan(1),
                    ])
                    ->columns(2),

                // Sección: Contenido
                Section::make('Contenido')
                    ->description('Escribe el contenido de tu artículo')
                    ->icon('heroicon-o-pencil')
                    ->schema([
                        Textarea::make('extracto')
                            ->label('Extracto / Resumen')
                            ->placeholder('Escribe un breve resumen del artículo...')
                            ->rows(3)
                            ->maxLength(300)
                            ->helperText('Aparece en las listas de artículos. Máximo 300 caracteres. Se genera automáticamente si lo dejas vacío.')
                            ->columnSpanFull(),

                        MarkdownEditor::make('contenido')
                            ->label('Contenido del Artículo')
                            ->placeholder('Escribe el contenido completo aquí...')
                            ->required()
                            ->fileAttachmentsDirectory('blog/contenido')
                            ->columnSpanFull(),
                    ]),

                // Sección: SEO
                Section::make('SEO (Opcional)')
                    ->description('Optimización para motores de búsqueda')
                    ->icon('heroicon-o-magnifying-glass')
                    ->collapsible()
                    ->schema([
                        TextInput::make('meta_descripcion')
                            ->label('Meta Descripción')
                            ->placeholder('Descripción corta para Google...')
                            ->maxLength(160)
                            ->helperText('Máximo 160 caracteres. Aparece en los resultados de búsqueda.'),

                        TextInput::make('meta_keywords')
                            ->label('Meta Keywords')
                            ->placeholder('salud, nutrición, consejos')
                            ->maxLength(255)
                            ->helperText('Palabras clave separadas por comas.'),
                    ])
                    ->columns(2),

                // Sección: Publicación
                Section::make('Publicación')
                    ->description('Configuración de publicación')
                    ->icon('heroicon-o-calendar')
                    ->schema([
                        Toggle::make('publicado')
                            ->label('Publicar artículo')
                            ->helperText('Solo los artículos publicados aparecen en el blog.')
                            ->default(false)
                            ->live()
                            ->columnSpan(1),

                        DateTimePicker::make('fecha_publicacion')
                            ->label('Fecha de Publicación')
                            ->native(false)
                            ->displayFormat('d/m/Y H:i')
                            ->default(now())
                            ->required()
                            ->visible(fn (callable $get) => $get('publicado'))
                            ->columnSpan(1),
                    ])
                    ->columns(2),
            ]);
    }
}
