<div>
    @if ($modalEdit)
        <div class="modald">
            <div class="modald-contenido">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-center">
                            <h4 class="modal-title" id="exampleModalLabel">Canciones - {{ $pedido->Mesa->nombre }}</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 my-2">
                                    <label for="">Detalles:</label>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Cancion</th>
                                                <th scope="col">Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pedido->Detalles as $detalle)
                                                <tr>
                                                    <td>{{ $detalle->Video->title }}</td>
                                                    <td>{{ $detalle->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-12">
                                    <div class="card text-center">
                                        <div class="card-header">
                                            Total de Canciones:
                                        </div>
                                        <div class="d-flex justify-content-center p-2">
                                            <div class="col-md-3">
                                                <label for="">{{ $pedido->Detalles->count() }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    @if (!$endOrder)
                                        <button wire:click="changeEndOrder('{{ true }}')"
                                            class="btn btn-danger">Terminar Mesa</button>
                                    @else
                                        <div class="card-header">
                                            <div class="d-flex align-items-center text-center justify-content-center">
                                                <h5>¿Estás seguro de terminar la mesa?</h5>
                                            </div>
                                        </div>

                                        <div class="modal-body">
                                            <div align="center">
                                                <button type="button" class="btn btn-secondary btn-sm my-2 mx-2"
                                                    wire:click="changeEndOrder('{{ false }}')">Cancelar</button>
                                                <button wire:click="finishOrder()"
                                                    class="btn btn-danger btn-sm my-2 mx-2">Si, Terminar</button>
                                            </div>
                                        </div>
                                    @endif
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
