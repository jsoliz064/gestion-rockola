@extends('adminlte::page')

@section('title', 'Videos')

@section('content_header')
    <div class="row d-flex justify-content-between">
        <div class="ml-3">
            <h1>VIDEOS</h1>
        </div>
    </div>
@stop

@section('content')
    @livewire('video.video-lw')
@stop

@section('css')
    @livewireStyles
@stop

@section('js')
    @livewireScripts
@stop
