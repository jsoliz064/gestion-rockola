<div>
    @if ($modalEdit)
        <div class="modald">
            <div class="modald-contenido">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Editar Mesa</h4>
                        </div>
                        <div class="modal-body">
                            <h5>Nombre:</h5>
                            <input type="text" wire:model="mesa.nombre" class="form-control">
                            @error('mesa.nombre')
                                <small class="text-danger">Debe ingresar un nombre</small>
                            @enderror

                            <h5>Sala:</h5>
                            <select wire:model="mesa.sala_id" class="form-control">
                                @foreach ($salas as $sala)
                                    <option value="{{ $sala->id }}">{{ $sala->nombre }}- {{ $sala->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mesa.sala_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

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
