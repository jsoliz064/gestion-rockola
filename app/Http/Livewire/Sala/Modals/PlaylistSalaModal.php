<?php

namespace App\Http\Livewire\Sala\Modals;

use App\Models\ListaReproduccion;
use App\Models\Sala;
use Livewire\Component;

class PlaylistSalaModal extends Component
{
    protected $listeners = ['openPlaylistSalaModal'];

    public $modalPlaylist = false;

    public $sala;

    public function render()
    {
        
        if ($this->sala) {
            $this->sala->refresh();
            $listaReproduccion = $this->sala->ListaReproduccion;
        } else {
            $listaReproduccion = null;
        }
        return view('livewire.sala.modals.playlist-sala-modal', compact('listaReproduccion'));
    }

    public function openPlaylistSalaModal($id)
    {
        $this->sala = Sala::find($id);
        $this->modalPlaylist = true;
    }

    public function enableVideo($id)
    {
        $playlistVideo = ListaReproduccion::find($id);
        $playlistVideo->update([
            'reproducido' => false
        ]);
        $this->render();
    }

    public function disableVideo($id)
    {
        $playlistVideo = ListaReproduccion::find($id);
        $playlistVideo->update([
            'reproducido' => true
        ]);
        $this->render();
    }

    public function deleteVideo($id)
    {
        $playlistVideo = ListaReproduccion::find($id);
        $playlistVideo->delete();
        $this->render();
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
