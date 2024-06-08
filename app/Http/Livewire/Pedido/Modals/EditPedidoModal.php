<?php

namespace App\Http\Livewire\Pedido\Modals;

use App\Models\Pedido;
use Livewire\Component;

class EditPedidoModal extends Component
{
    protected $listeners = ['openEditPedidoModal'];

    public $modalEdit = false;

    public $pedido;
    public $email = null;

    public function render()
    {
        return view('livewire.pedido.modals.edit-pedido-modal');
    }

    public function openEditPedidoModal($id)
    {
        $this->pedido = Pedido::find($id);
        $this->modalEdit = true;
    }

    public function update()
    {
        $this->validate([
            'pedido.nombre' => 'required|string|max:255',
            'pedido.descripcion' => 'nullable|string|max:255',
            'pedido.precio' => 'required|number',
            'pedido.stock' => 'nullable|number',
        ]);
        $pedido = Pedido::find($this->pedido['id']);
        $pedido->update($this->pedido);
        $this->emit('updatePedidoTable');
        $this->limpiar();
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->pedido = null;
        $this->modalEdit = false;
    }
}
