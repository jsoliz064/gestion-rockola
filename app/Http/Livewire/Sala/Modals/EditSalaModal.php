<?php

namespace App\Http\Livewire\Sala\Modals;

use App\Models\Sala;
use Livewire\Component;
use Illuminate\Support\Str;

class EditSalaModal extends Component
{
    protected $listeners = ['openEditSalaModal'];

    public $modalEdit = false;

    public $sala = [];

    public function render()
    {
        return view('livewire.sala.modals.edit-sala-modal');
    }

    public function openEditSalaModal($id)
    {
        $this->sala = Sala::find($id)->toArray();
        $this->modalEdit = true;
    }

    public function changeToken()
    {
        $this->sala['token'] = Str::uuid();
    }

    public function update()
    {
        $this->validate([
            'sala.nombre' => 'required|string|max:255',
            'sala.descripcion' => 'required|string|max:255',
            'sala.token' => 'required|string|max:255',
        ]);
        $sala = Sala::find($this->sala['id']);
        $sala->update($this->sala);
        $this->emit('updateSalaTable');
        $this->limpiar();
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->sala = null;
        $this->modalEdit = false;
    }
}
