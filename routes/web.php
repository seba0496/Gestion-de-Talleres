<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Prueba;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('livewire.prueba');
});
