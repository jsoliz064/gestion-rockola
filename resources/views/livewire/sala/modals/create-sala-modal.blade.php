<div>
    @if ($modalCrear)
        <div class="modald">
            <div class="modald-contenido">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Crear Sala</h4>
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

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="cancelar()">Cancelar</button>
                            <button type="button" class="btn btn-primary" wire:click="store()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
