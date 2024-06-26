<?php

namespace App\Http\Livewire\Sala;

use App\Models\Sala;
use App\Models\Sucursal;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

class SalaDatatable extends DataTableComponent
{
    protected $listeners = ['updateSalaTable'];
    protected $model = Sala::class;

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
            Column::make("Descripcion", "descripcion")
                ->sortable()
                ->searchable(),
            Column::make("Token", "token")
                ->sortable()
                ->searchable(),
            Column::make("Play/Pausa")
                ->label(
                    function ($row, Column $column) {
                        $row->refresh();
                        if (!$row->estado) {
                            return
                                "<button class='btn btn-outline-success btn-sm' wire:click='changeEstado($row)'>Play</button>";
                        } else {
                            return "
                            <button class='btn btn-outline-danger btn-sm' wire:click='changeEstado($row)'>Pausar</button>";
                        }
                    }
                )
                ->html(),
            Column::make('Acciones', 'id')
                ->format(function ($value, $row, Column $column) {
                    return view('livewire.sala.sala-vista-button', [
                        'row' => $row
                    ]);
                }),
        ];
    }

    public function builder(): Builder
    {
        return Sala::query()->where('sucursal_id', $this->sucursalModel->id);
    }

    public function edit($salaId)
    {
        $this->emit('openEditSalaModal', $salaId);
    }

    public function destroy($salaId)
    {
        $this->emit('openDestroySalaModal', $salaId);
    }

    public function addresses($salaId)
    {
        $this->emit('openAddressesSalaModal', $salaId);
    }

    public function playlist($salaId)
    {
        $this->emit('openPlaylistSalaModal', $salaId);
    }

    public function changeEstado(sala $sala)
    {
        $estado = $sala->estado;
        $sala->update([
            'estado' => !$estado
        ]);
    }

    public function updateSalaTable()
    {
        $this->builder();
    }
}
