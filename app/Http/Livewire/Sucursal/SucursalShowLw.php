<?php

namespace App\Http\Livewire\Sucursal;

use App\Models\Sucursal;
use Livewire\Component;

class SucursalShowLw extends Component
{
    public $sucursalModel;

    public $tabOption;

    public function __construct()
    {
        $tabOption = session('tabOption');
        $this->tabOption = $tabOption ?: "salas";
    }

    public function mount($sucursal_id)
    {
        $this->sucursalModel = Sucursal::find($sucursal_id);
    }

    public function render()
    {
        return view('livewire.sucursal.sucursal-show-lw');
    }

    public function handleChangeTabOption($value)
    {
        $this->tabOption = $value;
        session(['tabOption' => $this->tabOption]);
    }
}
