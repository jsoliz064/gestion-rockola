<?php

namespace App\Http\Livewire\Mesa\Modals;

use App\Models\Mesa;
use App\Models\Sala;
use App\Models\Sucursal;
use Livewire\Component;

class EditMesaModal extends Component
{
    protected $listeners = ['openEditMesaModal'];

    public $modalEdit = false;

    public $mesa = [];

    public $sucursalModel;
    public function mount($sucursal_id)
    {
        $this->sucursalModel = Sucursal::find($sucursal_id);
    }

    public function render()
    {
        $salas = Sala::where('salas.sucursal_id', $this->sucursalModel->id)
            ->get();
        return view('livewire.mesa.modals.edit-mesa-modal', compact('salas'));
    }

    public function openEditMesaModal($id)
    {
        $this->mesa = Mesa::find($id)->toArray();
        $this->modalEdit = true;
    }

    public function update()
    {
        $this->validate([
            'mesa.nombre' => 'required|string|max:255',
            'mesa.sala_id' => 'required|numeric',
        ]);
        $mesa = Mesa::find($this->mesa['id']);
        $mesa->update($this->mesa);
        $this->emit('updateMesaTable');
        $this->limpiar();
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->mesa = null;
        $this->modalEdit = false;
    }
}
