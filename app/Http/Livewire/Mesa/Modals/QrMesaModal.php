<?php

namespace App\Http\Livewire\Mesa\Modals;

use App\Models\Mesa;
use App\Models\Pedido;
use App\Traits\JwtTrait;
use Livewire\Component;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\Writer\ValidationException;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\DB;

class QrMesaModal extends Component
{
    use JwtTrait;

    protected $listeners = ['openQrMesaModal'];

    public $modalQr = false;
    public $mesa;
    public $imageQr;
    public $mesaPublicUrl = "";
    public $mesaPrivateUrl = "";

    public function render()
    {
        return view('livewire.mesa.modals.qr-mesa-modal');
    }

    public function openQrMesaModal($id)
    {
        $this->mesa = Mesa::find($id);
        $this->getQr();
        $this->modalQr = true;
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->mesa = null;
        $this->modalQr = false;
        $this->mesaPublicUrl = "";
    }

    public function createPedido()
    {
        DB::transaction(function () {
            $mesa = $this->mesa;
            $pedido = Pedido::create([
                'mesa_id' => $mesa->id,
                'sala_id' => $mesa->Sala->id,
                'sucursal_id' => $mesa->Sala->Sucursal->id,
            ]);

            return $pedido;
        });
        $this->emit('updateMesaTable');
        $this->emit('updatePedidoTable');
    }

    public function getQr()
    {
        $token = $this->mesa->token;
        $url = config('app.MY_HOST');
        $mesaUrl = "{$url}/rockola/mesa/{$token}";
        $this->mesaPublicUrl = $mesaUrl;
        $qrCode = QrCode::create($mesaUrl)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(250)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        // $logoPath = public_path('img/logoRockola.jpg');
        $logoPath = config('app.MY_HOST') . config('app.asset_url') . "/img/logoRockola.jpg";
        dd($logoPath);
        // Añadir depuración
        $logo = Logo::create($logoPath)
            ->setResizeToWidth(50);

        $writer = new PngWriter();
        $result = $writer->write($qrCode, $logo);
        $image = $result->getString();
        $imageData = base64_encode($image);
        $image = 'data:image/png;base64,' . $imageData;
        $this->imageQr = $image;
    }
}
