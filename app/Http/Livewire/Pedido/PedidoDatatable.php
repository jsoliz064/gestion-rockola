<?php

namespace App\Http\Livewire\Pedido;

use App\Models\Pedido;
use App\Models\Sucursal;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

class PedidoDatatable extends DataTableComponent
{
    protected $listeners = ['updatePedidoTable'];
    protected $model = Pedido::class;

    public $sucursalModel;
    public function mount($sucursal_id)
    {
        $this->sucursalModel = Sucursal::find($sucursal_id);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')->setDefaultSort('id', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
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
            Column::make("Mesa")
                ->label(
                    function ($row, Column $column) {
                        $row->refresh();
                        $mesa = $row->Mesa;
                        return $mesa->nombre;
                    }
                )
                ->sortable()
                ->searchable(),
            Column::make("Cant. Canciones")
                ->label(
                    function ($row, Column $column) {
                        $row->refresh();
                        $detalles = $row->Detalles;
                        return sizeof($detalles);
                    }
                )
                ->sortable()
                ->searchable(),
            Column::make("Fecha de Inicio", "created_at")
                ->sortable()
                ->searchable(),
            Column::make("Estado")
                ->label(
                    function ($row, Column $column) {
                        $row->refresh();
                        $terminado = $row->terminado;
                        if ($terminado) {
                            return '<span class="text-danger">Terminado</span>';
                        } else {
                            return '<span class="text-success">Reproduciendo</span>';
                        }
                    }
                )
                ->html(),
            Column::make('Acciones', 'id')
                ->format(function ($value, $row, Column $column) {
                    return view('livewire.pedido.pedido-vista-button', [
                        'row' => $row
                    ]);
                }),
        ];
    }

    public function builder(): Builder
    {
        return Pedido::query()->where('sucursal_id', $this->sucursalModel->id);
    }

    public function edit($pedidoId)
    {
        $this->emit('openEditPedidoModal', $pedidoId);
    }

    public function destroy($pedidoId)
    {
        $this->emit('openDestroyPedidoModal', $pedidoId);
    }

    public function updatePedidoTable()
    {
        $this->builder();
    }
}
