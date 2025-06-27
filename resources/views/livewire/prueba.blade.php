@extends('components.layouts.app')
@section('titulo', 'Prueba de Livewire')
@section('contenido')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Prueba de Livewire</h1>
    </div>
    <div class="card sm:card-side max-w-sm sm:max-w-full">
  <figure><img src="https://cdn.flyonui.com/fy-assets/components/card/image-7.png" alt="headphone" /></figure>
  <div class="card-body">
    <h5 class="card-title mb-0.5">Airpods Max</h5>
    <p class="mb-2">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
    <div class="card-actions">
      <button class="btn btn-primary">Buy Now</button>
      <button class="btn btn-secondary btn-soft">Add to cart</button>
    </div>
  </div>
</div>
@endsection