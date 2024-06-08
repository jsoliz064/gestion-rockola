<?php

namespace App\Http\Livewire\Sucursal;

use App\Models\Sucursal;
use Livewire\Component;

class SucursalLw extends Component
{
    protected $listeners = ['updateSucursalTable'];

    public function render()
    {
        $sucursales = Sucursal::all();
        return view('livewire.sucursal.sucursal-lw', compact('sucursales'));
    }

    public function openCreateSucursalModal()
    {
        $this->emit('openCreateSucursalModal');
    }

    public function updateSucursalTable(){
        $this->render();
    }
}
