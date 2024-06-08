<?php

namespace App\Http\Livewire\Sucursal\Modals;

use App\Models\Sucursal;
use Livewire\Component;

class CreateSucursalModal extends Component
{
    protected $listeners = ['openCreateSucursalModal'];

    public $modalCrear = false;
    public $sucursal = [];

    public function render()
    {
        return view('livewire.sucursal.modals.create-sucursal-modal');
    }

    public function openCreateSucursalModal()
    {
        $this->modalCrear = true;
    }

    public function store()
    {
        $this->validate([
            'sucursal.nombre' => 'required|string|max:255',
            'sucursal.direccion' => 'required|string|max:255',
        ]);

        Sucursal::create($this->sucursal);

        $this->emit('updateSucursalTable');
        $this->limpiar();
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->sucursal = [];
        $this->modalCrear = false;
    }
}
