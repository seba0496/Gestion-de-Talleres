<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Prueba;
use App\Livewire\Talleres;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('livewire.prueba');
});
Route::get('/talleres', function () {
    return view('talleres.index');
})->name('talleres');