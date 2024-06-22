<div>
    @if ($modalPlaylist)
        <div class="modald">
            <div class="modald-contenido">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-center">
                            <h4 class="modal-title" id="exampleModalLabel">Playlist actual - Sala {{ $sala->nombre }}</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 my-2">
                                    <label for="">Lista:</label>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Cancion</th>
                                                <th scope="col">Mesa</th>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($listaReproduccion as $elemento)
                                                <tr>
                                                    <td>{{ $elemento->Video->title }}</td>
                                                    <td>{{ $elemento->Mesa->nombre }}</td>
                                                    <td>{{ $elemento->created_at }}</td>
                                                    <td>
                                                        @if ($elemento->reproducido)
                                                            <button wire:click="enableVideo('{{ $elemento->id }}')"
                                                                class="btn btn-outline-success btn-sm">Habilitar</button>
                                                        @else
                                                            <button wire:click="disableVideo('{{ $elemento->id }}')"
                                                                class="btn btn-outline-warning btn-sm">Deshabilitar</button>
                                                        @endif
                                                        <button wire:click="deleteVideo('{{ $elemento->id }}')"
                                                            class="btn btn-outline-danger btn-sm">Quitar</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="cancelar()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
