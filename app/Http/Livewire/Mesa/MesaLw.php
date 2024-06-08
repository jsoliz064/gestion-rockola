<?php

namespace App\Http\Livewire\Mesa;

use App\Models\Sucursal;
use Livewire\Component;

class MesaLw extends Component
{
    public $sucursalModel;
    public function mount($sucursal_id)
    {
        $this->sucursalModel = Sucursal::find($sucursal_id);
    }
    
    public function render()
    {
        return view('livewire.mesa.mesa-lw');
    }

    public function openCreateMesaModal()
    {
        $this->emit('openCreateMesaModal');
    }
}
