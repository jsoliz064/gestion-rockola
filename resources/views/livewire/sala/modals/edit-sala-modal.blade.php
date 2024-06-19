<div>
    @if ($modalEdit)
        <div class="modald">
            <div class="modald-contenido">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Editar Sala</h4>
                        </div>
                        <div class="modal-body">
                            <h5>Nombre:</h5>
                            <input type="text" wire:model="sala.nombre" class="form-control">
                            @error('sala.nombre')
                                <small class="text-danger">Debe ingresar un nombre</small>
                            @enderror

                            <h5>Descripcion:</h5>
                            <input type="text" wire:model="sala.descripcion" class="form-control">
                            @error('sala.descripcion')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <h5>Token:</h5>
                            <input type="text" wire:model="sala.token" class="form-control" readonly="true">
                            @error('sala.descripcion')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <button wire:click="changeToken" class="btn btn-light my-1">Renovar Token</button>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="cancelar()">Cancelar</button>
                            <button type="button" class="btn btn-primary" wire:click="update()">Actualizar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
