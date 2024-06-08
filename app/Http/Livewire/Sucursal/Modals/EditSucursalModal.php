<?php

namespace App\Http\Livewire\Sucursal\Modals;

use App\Models\Sucursal;
use Livewire\Component;

class EditSucursalModal extends Component
{
    protected $listeners = ['openEditSucursalModal'];

    public $modalEdit = false;

    public $sucursal=[];

    public function render()
    {
        return view('livewire.sucursal.modals.edit-sucursal-modal');
    }

    public function openEditSucursalModal($id){
        $this->sucursal=Sucursal::find($id)->toArray();
        $this->modalEdit=true;
    }

    public function update(){
        $this->validate([
            'sucursal.nombre' => 'required|string|max:255',
            'sucursal.direccion' => 'required|string|max:255',
        ]);
        $sucursal=Sucursal::find($this->sucursal['id']);
        $sucursal->update($this->sucursal);
        $this->emit('updateSucursalTable');
        $this->limpiar();
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar(){
        $this->sucursal=null;
        $this->modalEdit=false;
    }
}
