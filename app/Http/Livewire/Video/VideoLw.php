<?php

namespace App\Http\Livewire\Video;

use Livewire\Component;

class VideoLw extends Component
{
    public function render()
    {
        return view('livewire.video.video-lw');
    }

    public function openCreateVideoModal()
    {
        $this->emit('openCreateVideoModal');
    }
}
