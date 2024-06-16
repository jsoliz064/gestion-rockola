@extends('adminlte::page')

@section('title', 'Rockola Search')

@section('content')
    <div id="app">
        <search></search>
    </div>
@stop

@section('css')
@stop

@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
@stop
