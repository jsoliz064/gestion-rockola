<?php

namespace App\Http\Livewire\Pedido\Modals;

use App\Models\Pedido;
use Livewire\Component;

class CreatePedidoModal extends Component
{
    protected $listeners = ['openCreatePedidoModal'];

    public $modalCrear = false;
    public $pedido = [];

    public function render()
    {
        return view('livewire.pedido.modals.create-pedido-modal');
    }

    public function openCreatePedidoModal()
    {
        $this->modalCrear = true;
    }

    public function store()
    {
        $this->validate([
            // 'pedido.nombre' => 'required|string|max:255',
            // 'pedido.descripcion' => 'nullable|string|max:255',
            // 'pedido.precio' => 'required|number',
            // 'pedido.stock' => 'nullable|number',
        ]);

        // Pedido::create($this->pedido);

        $this->emit('updatePedidoTable');
        $this->limpiar();
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->pedido = [];
        $this->modalCrear = false;
    }
}
