@extends('layouts.nav')

@section('title', 'Rockola Digital')

@section('content')
<div style="display: flex; justify-content: center; align-items: center; height: 80vh; flex-direction: column; text-align: center;">
    <img src="{{ asset('img/oops.png') }}" alt="Mesa Deshabilitada" style="max-width: 100%; height: auto; margin-bottom: 20px;">
    <div class="p-2">
        <h1 class="mt-4" style="font-size: 3rem; font-weight: bold; color: #343a40;">Mesa Deshabilitada</h1>
    <p class="mt-2" style="font-size: 1.25rem; color: #6c757d; max-width: 600px;">Lo siento, tu mesa está deshabilitada. Por favor, acércate al cajero para obtener más información y asistencia. Agradecemos tu comprensión.</p>
    </div>
</div>
</div>
@endsection

@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
