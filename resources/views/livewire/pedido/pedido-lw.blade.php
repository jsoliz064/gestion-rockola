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
            @can('pedidos.index')
                @livewire('pedido.pedido-datatable', ['sucursal_id' => $sucursalModel->id])
            @endcan
        </div>
    </div>
</div>
