<?php

namespace App\Http\Livewire\Video\Modals;

use App\Models\Video;
use Livewire\Component;

class DestroyVideoModal extends Component
{
    protected $listeners = ['openDestroyVideoModal'];

    public $modalDestroy = false;

    public $video=[];

    public function render()
    {
        return view('livewire.video.modals.destroy-video-modal');
    }

    public function openDestroyVideoModal($id){
        $this->video['id']=$id;
        $this->modalDestroy=true;
    }

    public function destroy()
    {
        $video=Video::find($this->video['id']);
        $video->delete();
        $this->emit('updateVideoTable');
        $this->modalDestroy=false;
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar(){
        $this->video=[];
        $this->modalDestroy=false;
    }
}
