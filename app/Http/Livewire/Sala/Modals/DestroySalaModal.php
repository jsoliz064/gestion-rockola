<?php

namespace App\Http\Livewire\Sala\Modals;

use App\Models\Sala;
use Livewire\Component;

class DestroySalaModal extends Component
{

    protected $listeners = ['openDestroySalaModal'];

    public $modalDestroy = false;

    public $sala=[];

    public function render()
    {
        return view('livewire.sala.modals.destroy-sala-modal');
    }

    public function openDestroySalaModal($id){
        $this->sala['id']=$id;
        $this->modalDestroy=true;
    }

    public function destroy()
    {
        $sala=Sala::find($this->sala['id']);
        $sala->delete();
        $this->emit('updateSalaTable');
        $this->modalDestroy=false;
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar(){
        $this->sala=[];
        $this->modalDestroy=false;
    }
}
