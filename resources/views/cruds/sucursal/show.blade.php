@extends('adminlte::page')

@section('title', 'Sucursal Detalle')

@section('content_header')
    <div class="row d-flex justify-content-center">
        <div class="ml-3">
            <h1>Sucursal - {{ $sucursal->nombre }}</h1>
        </div>
    </div>
@stop

@section('content')
    @livewire('sucursal.sucursal-show-lw', ['sucursal_id' => $sucursal->id])
@stop

@section('css')
    @livewireStyles
@stop

@section('js')
    @livewireScripts
@stop
