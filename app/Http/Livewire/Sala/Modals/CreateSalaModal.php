<?php

namespace App\Http\Livewire\Sala\Modals;

use App\Models\Sala;
use App\Models\Sucursal;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateSalaModal extends Component
{
    protected $listeners = ['openCreateSalaModal'];

    public $modalCrear = false;
    public $sala = [];

    public $sucursalModel;
    public function mount($sucursal_id)
    {
        $this->sucursalModel = Sucursal::find($sucursal_id);
    }

    public function render()
    {
        return view('livewire.sala.modals.create-sala-modal');
    }

    public function openCreateSalaModal()
    {
        $this->modalCrear = true;
    }

    public function store()
    {
        $this->validate([
            'sala.nombre' => 'required|string|max:255',
            'sala.descripcion' => 'required|string|max:255',
        ]);

        $this->sala['sucursal_id'] = $this->sucursalModel->id;
        $this->sala['token']=Str::uuid();
        Sala::create($this->sala);
        $this->emit('updateSalaTable');
        $this->limpiar();
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->sala = [];
        $this->modalCrear = false;
    }
}
