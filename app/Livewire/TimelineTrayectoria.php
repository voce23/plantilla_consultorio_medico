<?php

namespace App\Livewire;

use Livewire\Component;

// 📁 Archivo: app/Livewire/TimelineTrayectoria.php
// Componente Livewire para mostrar la trayectoria profesional del médico

class TimelineTrayectoria extends Component
{
    public array $eventos = [];

    public function mount(array $eventos = null)
    {
        // Si no se pasan eventos, usar datos de ejemplo
        $this->eventos = $eventos ?? [
            [
                'anio' => '2024',
                'titulo' => 'Director Médico',
                'institucion' => 'Clínica Médica Premium',
                'descripcion' => 'Liderazgo del equipo médico y supervisión de protocolos de atención',
                'tipo' => 'cargo',
            ],
            [
                'anio' => '2020',
                'titulo' => 'Especialización en Cardiología',
                'institucion' => 'Universidad Nacional de Medicina',
                'descripcion' => 'Estudios de posgrado con mención en cardiología intervencionista',
                'tipo' => 'estudio',
            ],
            [
                'anio' => '2015',
                'titulo' => 'Máster en Salud Pública',
                'institucion' => 'Universidad de Barcelona, España',
                'descripcion' => 'Programa de intercambio internacional con enfoque en prevención',
                'tipo' => 'estudio',
            ],
            [
                'anio' => '2010',
                'titulo' => 'Médico Titulado',
                'institucion' => 'Universidad Peruana Cayetano Heredia',
                'descripcion' => 'Título profesional de Médico Cirujano con honores',
                'tipo' => 'titulo',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.timeline-trayectoria');
    }
}
