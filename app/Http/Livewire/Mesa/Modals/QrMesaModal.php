<?php

namespace App\Http\Livewire\Mesa\Modals;

use App\Models\Mesa;
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

class QrMesaModal extends Component
{
    protected $listeners = ['openQrMesaModal'];

    public $modalQr = false;
    public $mesa;
    public $imageQr;

    public function render()
    {
        return view('livewire.mesa.modals.qr-mesa-modal');
    }

    public function openQrMesaModal($id)
    {
        $this->mesa = Mesa::find($id);
        $this->modalQr = true;
        $this->getQr();
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->mesa = null;
        $this->modalQr = false;
    }

    public function getQr()
    {
        //Libreria: https://github.com/endroid/qr-code
        $url = config('app.MY_HOST');
        $search_link = $url;

        $qrCode = QrCode::create($search_link)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(250)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        $logoPath = public_path('img/logoRockola.jpg');
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
