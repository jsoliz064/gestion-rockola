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
                            @if ($imageQr)
                                <img id="qrImage" src="{{ $imageQr }}" alt="QR Code">
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" onclick="downloadQr()">Descargar</button>
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
