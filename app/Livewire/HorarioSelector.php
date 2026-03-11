<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Doctor;
use App\Models\Cita;
use Carbon\Carbon;

// 📁 Archivo: app/Livewire/HorarioSelector.php
// Componente para seleccionar horarios disponibles de un doctor

class HorarioSelector extends Component
{
    public ?int $doctorId = null;
    public ?string $fecha = null;
    public ?string $horaSeleccionada = null;

    // Horarios disponibles por defecto (9am - 6pm, cada 30 min)
    public array $horarios = [];

    public function mount(?int $doctorId = null, ?string $fecha = null)
    {
        $this->doctorId = $doctorId;
        $this->fecha = $fecha ?? now()->format('Y-m-d');
        $this->generarHorarios();
    }

    public function updatedDoctorId($value)
    {
        $this->horaSeleccionada = null;
        $this->generarHorarios();
    }

    public function updatedFecha($value)
    {
        $this->horaSeleccionada = null;
        $this->generarHorarios();
    }

    public function seleccionarHora(string $hora)
    {
        $this->horaSeleccionada = $hora;
        $this->dispatch('horaSeleccionada', hora: $hora);
    }

    public function generarHorarios()
    {
        $this->horarios = [];

        if (!$this->doctorId || !$this->fecha) {
            return;
        }

        // Horario de atención: 9:00 AM a 6:00 PM
        $inicio = Carbon::createFromTime(9, 0);
        $fin = Carbon::createFromTime(18, 0);

        // Obtener citas existentes para este doctor y fecha
        $citasOcupadas = Cita::where('doctor_id', $this->doctorId)
            ->where('fecha', $this->fecha)
            ->whereIn('estado', ['pendiente', 'confirmada'])
            ->pluck('hora')
            ->map(fn ($hora) => Carbon::parse($hora)->format('H:i'))
            ->toArray();

        // Generar slots de 30 minutos
        while ($inicio <= $fin) {
            $hora = $inicio->format('H:i');

            $this->horarios[] = [
                'hora' => $hora,
                'disponible' => !in_array($hora, $citasOcupadas),
                'formato' => $inicio->format('h:i A'), // Formato 12 horas
            ];

            $inicio->addMinutes(30);
        }
    }

    public function render()
    {
        return view('livewire.horario-selector');
    }
}
