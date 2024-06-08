<div class="p-2">

    <head>
        <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    </head>
    <div>
        @livewire('video.modals.create-video-modal')
        @livewire('video.modals.edit-video-modal')
        @livewire('video.modals.destroy-video-modal')
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                @can('videos.create')
                    <button class="btn btn-primary my-3" wire:click='openCreateVideoModal'>Registrar Video</button>
                @endcan
            </div>
            @can('videos.index')
                @livewire('video.video-datatable')
            @endcan
        </div>
    </div>
</div>
