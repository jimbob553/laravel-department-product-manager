{{-- Blade Template: Department Products Page --}}
{{-- Displays products belonging to a specific department. --}}

@extends('layouts.post')
@section('title', $department->name . ' — Products')

@section('content')
  
  <div class="mb-6 rounded-2xl bg-gradient-to-r from-purple-700 to-yellow-300 text-white [text-shadow:0_1px_1px_rgba(0,0,0,0.45)] p-6">

    <div class="flex items-center justify-between gap-3">
      {{-- Department Title and Back Link --}}
      <h1 class="text-2xl font-semibold">{{ $department->name }} — Products</h1>
      <a href="{{ route('departments.index') }}"
         class="inline-flex items-center px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/20">
        ← Back to Departments
      </a>
    </div>
    {{-- Department Description --}}
    <p class="mt-1 text-white/80">Browse our {{ strtolower($department->name) }} collection.</p>
  </div>
  
  {{-- Loads products/create.blade.php  --}}
  @can('create', App\Models\Product::class)
  <div class="flex justify-end mb-4">
  <a href="{{ route('departments.products.create', $department) }}"
   class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
   Add New Product
  </a>
  </div>
  @endcan
  {{-- Check if there are products --}}
  @if ($products->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      {{-- Loop through products --}}
      @forelse ($products as $product)
      {{-- Use Product Card Component --}}
      <x-product-card :product="$product" />
    @empty
      <p>No products found.</p>
    @endforelse
  </div>
    <div class="mt-8 pagination-colors">
      {{ $products->links() }}
    </div>
  @else
    <p>No products found.</p>
  @endif
@endsection
