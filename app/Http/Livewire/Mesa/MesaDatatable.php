<?php

namespace App\Http\Livewire\Mesa;

use App\Models\Mesa;
use App\Models\Sucursal;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

class MesaDatatable extends DataTableComponent
{
    protected $listeners = ['updateMesaTable'];
    protected $model = Mesa::class;

    public $sucursalModel;
    public function mount($sucursal_id)
    {
        $this->sucursalModel = Sucursal::find($sucursal_id);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->searchable(),
            Column::make("Nombre", "nombre")
                ->sortable()
                ->searchable(),
            Column::make("Sala")
                ->label(
                    function ($row, Column $column) {
                        $row->refresh();
                        $sala = $row->Sala;
                        return $sala->nombre;
                    }
                )
                ->sortable()
                ->searchable(),
            Column::make("Estado")
                ->label(
                    function ($row, Column $column) {
                        $row->refresh();
                        $order = $row->Pedido();
                        if (is_null($order)) {
                            return '<span class="text-success">Libre</span>';
                        } else {
                            return '<span class="text-danger">Ocupada</span>';
                        }
                    }
                )
                ->html(),
            Column::make('Acciones', 'id')
                ->format(function ($value, $row, Column $column) {
                    return view('livewire.mesa.mesa-vista-button', [
                        'row' => $row
                    ]);
                }),
        ];
    }

    public function builder(): Builder
    {
        return Mesa::query()->join('salas', 'salas.id', 'mesas.sala_id')->where('salas.sucursal_id', $this->sucursalModel->id);
        // return Mesa::query();
    }

    public function edit($mesaId)
    {
        $this->emit('openEditMesaModal', $mesaId);
    }

    public function destroy($mesaId)
    {
        $this->emit('openDestroyMesaModal', $mesaId);
    }

    public function qr($mesaId)
    {
        $this->emit('openQrMesaModal', $mesaId);
    }

    public function updateMesaTable()
    {
        $this->builder();
    }
}
