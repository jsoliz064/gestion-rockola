<?php

namespace App\Http\Livewire\Video\Modals;

use App\Models\Video;
use Livewire\Component;

class CreateVideoModal extends Component
{
    protected $listeners = ['openCreateVideoModal'];

    public $modalCrear = false;
    public $video = [];

    public function render()
    {
        return view('livewire.video.modals.create-video-modal');
    }

    public function openCreateVideoModal()
    {
        $this->modalCrear = true;
    }

    public function store()
    {
        $this->validate([
            'video.videoId' => 'required|string|max:255',
            'video.title' => 'required|string|max:255',
            'video.thumbnails_default' => 'required|string|max:255',
            'video.thumbnails_medium' => 'required|string|max:255',
            'video.thumbnails_heigh' => 'required|string|max:255',
        ]);

        Video::create($this->video);

        $this->emit('updateVideoTable');
        $this->limpiar();
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->video = [];
        $this->modalCrear = false;
    }
}
