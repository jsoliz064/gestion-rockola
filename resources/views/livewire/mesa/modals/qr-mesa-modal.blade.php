<div>
    @if ($modalQr)
        <div class="modald">
            <div class="modald-contenido">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-center">
                            <h4 class="modal-title" id="exampleModalLabel">QR del Buscador de Canciones</h4>
                        </div>

                        <div class="modal-body d-flex justify-content-center">
                            @if ($mesaUrl)
                                @if ($imageQr)
                                    <div class="row">
                                        <div class="row-12">
                                            <img id="qrImage" src="{{ $imageQr }}" alt="QR Code">
                                        </div>
                                        <div class="col-12" style="width: 10px;">
                                            <p>{{ $mesaUrl }}</p>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="row text-center justify-content-center">
                                    <label for="">La mesa se encuentra libre. Haga Click en "Habilitar Mesa"
                                        para
                                        permitir solicitar canciones</label>
                                    <button wire:click="createPedido()" class="btn btn-primary">Habilitar Mesa</button>
                                </div>
                            @endif
                        </div>

                        <div class="modal-footer">
                            @if ($mesaUrl)
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
