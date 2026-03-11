<?php

namespace App\Filament\Resources\Servicios\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ServicioInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('especialidad.id')
                    ->label('Especialidad')
                    ->placeholder('-'),
                TextEntry::make('nombre'),
                TextEntry::make('slug'),
                TextEntry::make('descripcion')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('precio')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('duracion_minutos')
                    ->numeric(),
                TextEntry::make('imagen')
                    ->placeholder('-'),
                IconEntry::make('activo')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
