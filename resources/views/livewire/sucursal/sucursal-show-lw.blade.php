<div class="py-3">
    <div class="card">
        <div class="card-body">
            <ul id="tabs" class="nav nav-tabs">
                <li class="nav-item"><a href="" data-target="#pedidos" data-toggle="tab"
                        class="nav-link text-uppercase @if ($tabOption == 'pedidos') active @endif"
                        wire:click='handleChangeTabOption("pedidos")'>Pedidos</a></li>

                <li class="nav-item"><a href="" data-target="#salas" data-toggle="tab"
                        class="nav-link text-uppercase  @if ($tabOption == 'salas') active @endif"
                        wire:click='handleChangeTabOption("salas")'>Salas</a></li>

                <li class="nav-item"><a href="" data-target="#mesas" data-toggle="tab"
                        class="nav-link text-uppercase @if ($tabOption == 'mesas') active @endif"
                        wire:click='handleChangeTabOption("mesas")'>Mesas</a></li>
            </ul>
            <br>
            <div id="tabsContent" class="tab-content">
                <div class="tab-pane fade @if ($tabOption === 'pedidos') active show @endif">
                    @livewire('pedido.pedido-lw', ['sucursal_id' => $sucursalModel->id])
                </div>
                <div class="tab-pane fade @if ($tabOption === 'salas') active show @endif">
                    @livewire('sala.sala-lw', ['sucursal_id' => $sucursalModel->id])
                </div>
                <div class="tab-pane fade @if ($tabOption == 'mesas') active show @endif">
                    @livewire('mesa.mesa-lw', ['sucursal_id' => $sucursalModel->id])
                </div>
            </div>
        </div>
    </div>
</div>
