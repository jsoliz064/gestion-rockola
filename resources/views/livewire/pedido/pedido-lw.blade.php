<div class="py-4">

    <head>
        <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    </head>
    <div>
        @livewire('pedido.modals.create-pedido-modal')
        @livewire('pedido.modals.edit-pedido-modal')
        @livewire('pedido.modals.destroy-pedido-modal')
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                @can('pedidos.create')
                    {{-- <button class="btn btn-primary my-3" wire:click='openCreatePedidoModal'>Registrar Pedio</button> --}}
                @endcan
            </div>
            @can('pedidos.index')
                @livewire('pedido.pedido-datatable')
            @endcan
        </div>
    </div>
</div>
