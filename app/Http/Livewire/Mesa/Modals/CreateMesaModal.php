<?php

namespace App\Http\Livewire\Mesa\Modals;

use App\Models\Mesa;
use App\Models\Sala;
use App\Models\Sucursal;
use Livewire\Component;

class CreateMesaModal extends Component
{
    protected $listeners = ['openCreateMesaModal'];

    public $modalCrear = false;
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

        return view('livewire.mesa.modals.create-mesa-modal', compact('salas'));
    }

    public function openCreateMesaModal()
    {
        $this->modalCrear = true;
    }

    public function store()
    {
        $this->validate([
            'mesa.nombre' => 'required|string|max:255',
            'mesa.sala_id' => 'required|numeric',
        ]);

        Mesa::create($this->mesa);

        $this->emit('updateMesaTable');
        $this->limpiar();
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->mesa = [];
        $this->modalCrear = false;
    }
}
