<?php

namespace App\Http\Livewire\Pedido\Modals;

use App\Models\Pedido;
use Livewire\Component;

class EditPedidoModal extends Component
{
    protected $listeners = ['openEditPedidoModal'];

    public $modalEdit = false;

    public $pedido;
    public $endOrder = false;

    public function render()
    {
        return view('livewire.pedido.modals.edit-pedido-modal');
    }

    public function changeEndOrder($value)
    {
        $this->endOrder = $value;
    }

    public function openEditPedidoModal($id)
    {
        $this->pedido = Pedido::find($id);
        $this->modalEdit = true;
    }

    public function finishOrder()
    {
        $pedido = Pedido::find($this->pedido->id);
        $pedido->update([
            'terminado' => true
        ]);
        $this->limpiar();
        $this->emit('updatePedidoTable');
        $this->emit('updateMesaTable');
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->pedido = null;
        $this->modalEdit = false;
        $this->endOrder = false;
    }
}
