<div>
    @if ($modalQr)
        <div class="modald">
            <div class="modald-contenido">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-center">
                            <h4 class="modal-title" id="exampleModalLabel">QR del Buscador de Canciones</h4>
                        </div>

                        <div class="modal-body">
                            @if ($imageQr)
                                <div class="row">
                                    <div class="col-12  d-flex justify-content-center">
                                        <img id="qrImage" src="{{ $imageQr }}" alt="QR Code">
                                    </div>
                                    <div class="col-12" style="width: 10px;">
                                        <label for="">URL Publica:</label>
                                        <p>{{ $mesaPublicUrl }}</p>
                                    </div>
                                </div>
                            @endif

                            @php
                                $pedido = $mesa->Pedido();
                            @endphp
                            <hr>
                            <div class="row">
                                @if ($pedido == null)
                                    <label for="" class="text-center">Mesa Libre. Haga click en
                                        "Habilitar Mesa"
                                        para
                                        permitir solicitar canciones</label>
                                    <div class="col-12 text-center">
                                        <button wire:click="createPedido()"
                                            class="btn btn-primary text-center">Habilitar Mesa</button>
                                    </div>
                                @else
                                    <div class="col-12 " style="width: 10px;">
                                        <label for="">URL Privada:</label>
                                        @if ($pedido->invitacion_url)
                                            <p> {{ $pedido->invitacion_url }}</p>
                                        @else
                                            <p class="text-center" style="color: red">(Espere a que el cliente ingrese a la mesa)</p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                        </div>

                        <div class="modal-footer">
                            @if ($mesaPublicUrl)
                                <button type="button" class="btn btn-success" onclick="downloadQr()">Descargar</button>
                            @endif
                            <button type="button" class="btn btn-secondary" wire:click="cancelar()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script>
        function downloadQr() {
            const qrImage = document.getElementById('qrImage');
            const qrSrc = qrImage.src;

            const link = document.createElement('a');
            link.href = qrSrc;
            link.download = 'qr_code.png';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
</div>
