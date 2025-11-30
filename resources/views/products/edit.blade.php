{{-- resources/views/products/edit.blade.php --}}
{{-- Edits an existing product and reuses _form partial --}}


@extends('layouts.post')


@section('title', 'Edit ' . $product->name)

@section('content')
  <div class="max-w-2xl mx-auto bg-white shadow-md rounded-xl p-6">
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl font-bold text-purple-700">Edit {{ $product->name }}</h1>
      <a href="{{ route('departments.products.show', [$department, $product]) }}" 
        class="text-md bg-orange-400 text-white px-3 py-1.5 rounded hover:bg-orange-700">
        Back to Product
      </a>
    </div>

    {{-- Edit Form --}}
    <form method="POST" action="{{ route('departments.products.update', [$department, $product]) }}">
      @csrf
      @method('PUT')
      {{-- Reuse the form partial --}}
      @include('products._form', [
        'buttonText' => 'Update Product',
        'department' => $department,
        'product' => $product
      ])
    </form>
  </div>
@endsection


