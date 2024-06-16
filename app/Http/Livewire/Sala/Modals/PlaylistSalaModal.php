<?php

namespace App\Http\Livewire\Sala\Modals;

use App\Models\Sala;
use Livewire\Component;

class PlaylistSalaModal extends Component
{
    protected $listeners = ['openPlaylistSalaModal'];

    public $modalPlaylist = false;

    public $sala;

    public function render()
    {
        return view('livewire.sala.modals.playlist-sala-modal');
    }

    public function openPlaylistSalaModal($id)
    {
        $this->sala = Sala::find($id);
        $this->modalPlaylist = true;
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->sala = null;
        $this->modalPlaylist = false;
    }
}
