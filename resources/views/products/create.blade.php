{{-- resources/views/products/create.blade.php --}}
@extends('layouts.post')

@section('title', 'Add New Product')

@section('content')
  <h1 class="text-2xl font-bold mb-4">Add New Product</h1>

  <form method="POST" action="{{ route('departments.products.store', $department) }}">
      @csrf
      @include('products._form', [
        'buttonText' => 'Create Product',
        'department' => $department,
        'product' => $product
    ])
      
        
  </form >
@endsection