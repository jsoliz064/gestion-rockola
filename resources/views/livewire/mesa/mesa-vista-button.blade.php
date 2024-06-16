<div>

    <head>
        <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}">
    </head>
    <div class="dropdown dropdown-personalizado">
        <button class="btn bt-link" type="button" data-toggle="dropdown" data-toggle="popover" data-trigger="hover">
            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-personalizado">
            @can('mesas.edit')
                <a class="dropdown-item" href="#" wire:click="edit({{ $row->id }})">Editar</a>
            @endcan
            @can('mesas.qr')
                <a class="dropdown-item" href="#" wire:click="qr({{ $row->id }})">QR</a>
            @endcan
            @can('mesas.delete')
                <a class="dropdown-item" style="color: red" href="#"
                    wire:click="destroy({{ $row->id }})">Eliminar</a>
            @endcan
        </div>
    </div>
</div>
