{{-- Blade View: Product Show Page --}}
{{-- Displays a single product and its details within a department --}}

@extends('layouts.post')

@section('title', $product->name)

@section('content')
  <div class="max-w-3xl mx-auto bg-white shadow-md rounded-xl p-6">
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl font-bold text-purple-700">{{ $product->name }}</h1>

      {{-- Back button --}}
      <a href="{{ route('departments.products.index', $department) }}" 
         class="text-md bg-pink-400 text-white px-3 py-1.5 rounded hover:bg-pink-700">
        ← Back to {{ $department->name }} Products
      </a>
    </div>

    {{-- Product Details --}}
    <div class="space-y-2 mb-4">
      <p><span class="font-semibold text-gray-800">Department:</span> {{ $department->name }}</p>
      <p><span class="font-semibold text-gray-800">Price:</span> ${{ number_format($product->price, 2) }}</p>

      @if ($product->description)
        <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
      @else
        <p class="text-gray-500 italic">No description available.</p>
      @endif

      @if ($product->image_url)
        <div class="mt-4">
          <img src="{{ $product->image_url }}" 
               alt="Image of {{ $product->name }}"
               class="rounded-lg shadow-md max-h-64 object-cover">
        </div>
      @endif
    </div>

    {{-- Action Buttons --}}
    <div class="flex gap-3 mt-6">
      {{-- Edit visible to Admins and Managers --}}
      @can('update', $product)
        <a href="{{ route('departments.products.edit', [$department, $product]) }}" 
           class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
          Edit
        </a>
      @endcan

      {{-- Delete visible to Admins only --}}
      @can('delete', $product)
        <form method="POST" 
              action="{{ route('departments.products.destroy', [$department, $product]) }}"
              onsubmit="return confirm('Are you sure you want to delete this product?')">
          @csrf
          @method('DELETE')
          <button type="submit" 
                  class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
            Delete
          </button>
        </form>
      @endcan
    </div>
  </div>
@endsection
