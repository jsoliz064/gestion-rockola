<?php

namespace App\Http\Livewire\Sucursal\Modals;

use App\Models\Sucursal;
use Livewire\Component;

class DestroySucursalModal extends Component
{

    protected $listeners = ['openDestroySucursalModal'];

    public $modalDestroy = false;

    public $sucursal=[];

    public function render()
    {
        return view('livewire.sucursal.modals.destroy-sucursal-modal');
    }

    public function openDestroySucursalModal($id){
        $this->sucursal['id']=$id;
        $this->modalDestroy=true;
    }

    public function destroy()
    {
        $sucursal=Sucursal::find($this->sucursal['id']);
        $sucursal->delete();
        $this->emit('updateSucursalTable');
        $this->modalDestroy=false;
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar(){
        $this->sucursal=[];
        $this->modalDestroy=false;
    }
}
