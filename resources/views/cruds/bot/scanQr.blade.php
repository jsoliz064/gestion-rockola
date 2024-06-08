@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <div class="row d-flex justify-content-between">
        <div class="ml-3">
            <h1>Bot WhatsApp</h1>
        </div>
        <div class="mr-3 row breadcrumb">
        </div>
    </div>
@stop

@section('content')
    @livewire('bot.scan-qr')
@stop

@section('css')
    @livewireStyles
@stop

@section('js')
    @livewireScripts
@stop
