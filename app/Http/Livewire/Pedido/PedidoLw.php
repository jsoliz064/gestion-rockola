<?php

namespace App\Http\Livewire\Pedido;

use App\Models\Sucursal;
use Livewire\Component;

class PedidoLw extends Component
{

    public $sucursalModel;
    public function mount($sucursal_id)
    {
        $this->sucursalModel = Sucursal::find($sucursal_id);
    }
    
    public function render()
    {
        return view('livewire.pedido.pedido-lw');
    }
}
