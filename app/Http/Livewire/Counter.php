<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Client;

class Counter extends Component
{
    public $count = 0;
    public $clientName;

    public function mount()
    {
        // Obtiene un cliente aleatorio (si existe)
        $client = Client::inRandomOrder()->first();

        // Si hay clientes, guarda el nombre; si no, muestra un fallback
        $this->clientName = $client ? $client->user->name : 'No hay clientes disponibles';
    }

    public function increment()
    {
        $this->count++;
        $client = Client::inRandomOrder()->first();
        $this->clientName = $client ? $client->user->name : 'No hay clientes disponibles';;
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
