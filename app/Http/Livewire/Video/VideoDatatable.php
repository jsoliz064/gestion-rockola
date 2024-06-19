<?php

namespace App\Http\Livewire\Video;

use App\Models\Video;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

class VideoDatatable extends DataTableComponent
{
    protected $listeners = ['updateVideoTable'];
    protected $model = Video::class;

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
            Column::make("Video ID", "videoId")
                ->sortable()
                ->searchable(),
            Column::make("Titulo", "title")
                ->sortable()
                ->searchable(),
            Column::make("Duracion", "duration")
                ->sortable()
                ->searchable(),
            Column::make('Acciones', 'id')
                ->format(function ($value, $row, Column $column) {
                    return view('livewire.video.video-vista-button', [
                        'row' => $row
                    ]);
                }),
        ];
    }

    public function builder(): Builder
    {
        return Video::query();
    }

    public function edit($videoId)
    {
        $this->emit('openEditVideoModal', $videoId);
    }

    public function destroy($videoId)
    {
        $this->emit('openDestroyVideoModal', $videoId);
    }

    public function updateVideoTable()
    {
        $this->builder();
    }
}
