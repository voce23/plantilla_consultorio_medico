<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Testimonio;

// 📁 Archivo: app/Livewire/CarruselTestimonios.php
// Componente para mostrar un carrusel de testimonios de pacientes

class CarruselTestimonios extends Component
{
    public int $testimonioActual = 0;
    public array $testimonios = [];
    public bool $autoPlay = true;
    public int $intervalo = 5000; // 5 segundos

    public function mount(int $cantidad = 6, bool $autoPlay = true)
    {
        $this->autoPlay = $autoPlay;
        $this->testimonios = Testimonio::aprobados()
            ->destacados()
            ->recientes()
            ->limit($cantidad)
            ->get()
            ->toArray();
    }

    public function siguiente()
    {
        $this->testimonioActual = ($this->testimonioActual + 1) % count($this->testimonios);
    }

    public function anterior()
    {
        $this->testimonioActual = ($this->testimonioActual - 1 + count($this->testimonios)) % count($this->testimonios);
    }

    public function irA(int $index)
    {
        $this->testimonioActual = $index;
    }

    public function render()
    {
        return view('livewire.carrusel-testimonios');
    }
}
