<div class="p-2">

    <head>
        <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    </head>
    <div>
        @livewire('sala.modals.create-sala-modal', ['sucursal_id' => $sucursalModel->id])
        @livewire('sala.modals.edit-sala-modal')
        @livewire('sala.modals.destroy-sala-modal')
        @livewire('sala.modals.playlist-sala-modal')
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                @can('salas.create')
                    <button class="btn btn-primary my-3" wire:click='openCreateSalaModal'>Registrar Sala</button>
                @endcan
            </div>
            @can('salas.index')
                @livewire('sala.sala-datatable', ['sucursal_id' => $sucursalModel->id])
            @endcan
        </div>
    </div>
</div>
