{{-- Blade View: Products Index Page --}}
{{-- Displays a list of all products with options to view details or add new products --}}

@extends('layouts.post')

@section('title', 'All Products')

@section('content')
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">All Products</h1>
    <div class="flex gap-3">
      <a href="{{ route('departments.index') }}"
         class="bg-pink-400 text-white px-4 py-2 rounded hover:bg-purple-700">
        ← Back to Departments
      </a>

      {{-- Add New Product (Admins only) --}}
      @can('create', App\Models\Product::class)
        <a href="{{ route('departments.products.create', $department) }}" 
           class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
          + Add New Product
        </a>
      @endcan
    </div>
  </div>

  {{-- Product List --}}
  @if ($products->count())
    <ul class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
    
      @foreach ($products as $product)
        <li class="border rounded-lg p-4 shadow-sm bg-white">
          <h2 class="font-semibold text-lg mb-2">{{ $product->name }}</h2>
          <p class="text-gray-700 mb-1">Price: ${{ number_format($product->price, 2) }}</p>
          <p class="text-gray-600 text-sm mb-3">Department: {{ $product->department->name }}</p>
          
          <div class="flex gap-3">
            <a href="{{ route('departments.products.show', [$product->department, $product]) }}" 
               class="text-yellow-600 hover:underline">View</a>

            {{-- Edit visible to Admin + Manager --}}
            @can('update', $product)
              <a href="{{ route('departments.products.edit', [$product->department, $product]) }}"
                 class="text-blue-600 hover:underline">Edit</a>
            @endcan

            {{-- Delete visible to Admin only --}}
            @can('delete', $product)
              <form method="POST"
                    action="{{ route('departments.products.destroy', [$product->department, $product]) }}"
                    onsubmit="return confirm('Are you sure you want to delete {{ $product->name }}?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline">Delete</button>
              </form>
            @endcan
          </div>
        </li>
      @endforeach
    </ul>

    <div class="mt-6">
      {{ $products->links() }}
    </div>
  @else
    <p>No products found.</p>
  @endif
@endsection
