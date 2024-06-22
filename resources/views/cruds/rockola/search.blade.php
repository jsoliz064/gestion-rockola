@extends('layouts.nav')

@section('title', 'Rockola Digital')

@section('content')
    <div id="app">
        <search :token="'{{ $token }}'"></search>
    </div>
@endsection

@section('js')
    <script src="{{ asset(mix('js/app.js')) }}"></script>
@endsection
