@extends('layouts.app')
@section('title', 'Talleres')
@section('content')
    <div class="max-w-4xl mx-auto space-y-8">
        @livewire('taller-form')
        @livewire('listar-talleres')
    </div>
@endsection
