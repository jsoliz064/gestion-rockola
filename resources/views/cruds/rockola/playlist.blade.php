@extends('adminlte::page')

@section('title', 'Rockola Playlist')

@section('content')
    <div id="app">
        {{-- <play-list></play-list> --}}
        <test></test>
    </div>
@stop

@section('css')
@stop

@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
@stop
