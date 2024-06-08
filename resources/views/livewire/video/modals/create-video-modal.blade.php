<div>
    @if ($modalCrear)
        <div class="modald">
            <div class="modald-contenido">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Crear Video</h4>
                        </div>
                        <div class="modal-body">

                            <h5>Video ID:</h5>
                            <input type="text" wire:model="video.videoId" class="form-control">
                            @error('video.videoId')
                                <small class="text-danger">Debe ingresar un id</small>
                            @enderror

                            <h5>Titulo:</h5>
                            <input type="text" wire:model="video.title" class="form-control">
                            @error('video.title')
                                <small class="text-danger">campo requerido</small>
                            @enderror

                            <h5>Url miniatura default:</h5>
                            <input type="text" wire:model="video.thumbnails_default" class="form-control">
                            @error('video.thumbnails_default')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            
                            <h5>Url miniatura medium:</h5>
                            <input type="text" wire:model="video.thumbnails_medium" class="form-control">
                            @error('video.thumbnails_medium')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            
                            <h5>Url miniatura heigh:</h5>
                            <input type="text" wire:model="video.thumbnails_heigh" class="form-control">
                            @error('video.thumbnails_heigh')
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
