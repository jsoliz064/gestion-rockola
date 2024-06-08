<div class="p-2">

    <head>
        <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    </head>
    <div>
        @livewire('sucursal.modals.create-sucursal-modal')
        @livewire('sucursal.modals.edit-sucursal-modal')
        @livewire('sucursal.modals.destroy-sucursal-modal')
    </div>
    @can('sucursales.create')
        <button class="btn btn-primary my-3" wire:click='openCreateSucursalModal'>Registrar sucursal</button>
    @endcan

    <div class="row">
        @foreach ($sucursales as $sucursal)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-center">
                        <div class="card-title">
                            <h5 style="font-weight: bold;">{{ $sucursal->nombre }}</h5>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row justify-content-around">
                            <a href="{{ route('sucursales.show', $sucursal) }}" class="card-link">Ver Salas</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
