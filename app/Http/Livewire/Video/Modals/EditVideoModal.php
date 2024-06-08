<?php

namespace App\Http\Livewire\Video\Modals;

use App\Models\Video;
use Livewire\Component;

class EditVideoModal extends Component
{
    protected $listeners = ['openEditVideoModal'];

    public $modalEdit = false;

    public $video = [];

    public function render()
    {
        return view('livewire.video.modals.edit-video-modal');
    }

    public function openEditVideoModal($id)
    {
        $this->video = Video::find($id)->toArray();
        $this->modalEdit = true;
    }

    public function update()
    {
        $this->validate([
            'video.videoId' => 'required|string|max:255',
            'video.title' => 'required|string|max:255',
            'video.thumbnails_default' => 'required|string|max:255',
            'video.thumbnails_medium' => 'required|string|max:255',
            'video.thumbnails_heigh' => 'required|string|max:255',
        ]);
        $video = Video::find($this->video['id']);
        $video->update($this->video);
        $this->emit('updateVideoTable');
        $this->limpiar();
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->video = null;
        $this->modalEdit = false;
    }
}
