<?php

namespace App\Http\Livewire\Sala;

use App\Models\Sucursal;
use Livewire\Component;

class SalaLw extends Component
{
    public $sucursalModel;
    public function mount($sucursal_id)
    {
        $this->sucursalModel = Sucursal::find($sucursal_id);
    }

    public function render()
    {
        return view('livewire.sala.sala-lw');
    }

    public function openCreateSalaModal()
    {
        $this->emit('openCreateSalaModal');
    }
}
