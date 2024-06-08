<div>
    @if ($modalEdit)
        <div class="modald">
            <div class="modald-contenido">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Detalles del pedido {{ $pedido->id }}</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 my-2">
                                    <label for="">Cliente:</label>
                                    <input type="text" value="{{ $pedido->Cliente->nombre }}" readonly="true"
                                        class="form-control">
                                </div>

                                <div class="col-12 my-2">
                                    <label for="">Estado del pedido:</label>
                                    <input type="text" value="{{ $pedido->estado }}" readonly="true"
                                        class="form-control">
                                </div>

                                <div class="col-12 my-2">
                                    <label for="">Fecha de pedido:</label>
                                    <input type="text" value="{{ $pedido->created_at }}" readonly="true"
                                        class="form-control">
                                </div>

                                <div class="col-12 my-2">
                                    <label for="">Fecha de entrega:</label>
                                    <input type="text" value="{{ $pedido->fecha_entrega }}" readonly="true"
                                        class="form-control">
                                </div>

                                <div class="col-12 my-2">
                                    <label for="">Descripcion del pedido:</label>
                                    <input type="text" value="{{ $pedido->descripcion }}" readonly="true"
                                        class="form-control">
                                </div>

                                <div class="col-12 my-2">
                                    <label for="">Latitud:</label>
                                    <input type="text" value="{{ $pedido->latitud }}" readonly="true"
                                        class="form-control">
                                </div>

                                <div class="col-12 my-2">
                                    <label for="">Longitud:</label>
                                    <input type="text" value="{{ $pedido->longitud }}" readonly="true"
                                        class="form-control">
                                </div>

                                <div class="col-12 my-2">
                                    <label for="">Detalles:</label>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Producto</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Precio Bs</th>
                                                <th scope="col">Subtotal Bs</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pedido->Detalles as $detalle)
                                                <tr>
                                                    <td>{{ $detalle->Producto->nombre }}</td>
                                                    <td>{{ $detalle->cantidad }}</td>
                                                    <td>{{ $detalle->precio }}</td>
                                                    <td>{{ $detalle->subtotal }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-12">
                                    <div class="card text-center">
                                        <div class="card-header">
                                            Total Pagado:
                                        </div>
                                        <div class="d-flex justify-content-center p-2">
                                            <div class="col-md-3">
                                                <label for="">Subtotal</label>
                                                <input value="{{ $pedido->subtotal }}" type="number" readonly="true"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-3">
                                                <label for="">Descuento</label>
                                                <input value="{{ $pedido->descuento }}" type="number"
                                                    placeholder="descuento" readonly="true" class="form-control">
                                            </div>

                                            <div class="col-md-3">
                                                <label for="">Total</label>
                                                <input value="{{ $pedido->total }}" type="number"
                                                    placeholder="descuento" readonly="true" class="form-control">
                                            </div>
                                        </div>
                                    </div>
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
