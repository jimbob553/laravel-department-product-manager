@extends('layouts.post')

@section('title', $department->name)

@section('content')
  <div class="max-w-3xl mx-auto bg-white shadow-md rounded-xl p-6">
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl font-bold text-purple-700">{{ $department->name }}</h1>
      <a href="{{ route('departments.index') }}" 
         class="text-md bg-pink-400 text-white px-3 py-1.5 rounded hover:bg-pink-700">
        ← Back to Departments
      </a>
    </div>

    @if ($department->description)
      <p class="text-gray-700 mb-4">{{ $department->description }}</p>
    @endif

    {{-- Admin + Manager can edit / Admin can delete --}}
    <div class="flex gap-3 mt-6">
      @can('update', $department)
        <a href="{{ route('departments.edit', $department) }}" 
           class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
          Edit
        </a>
      @endcan

      @can('delete', $department)
        <form method="POST" 
              action="{{ route('departments.destroy', $department) }}"
              onsubmit="return confirm('Are you sure you want to delete this department?')">
          @csrf
          @method('DELETE')
          <button type="submit" 
                  class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
            Delete
          </button>
        </form>
      @endcan
    </div>

    {{-- Products List --}}
    @if ($department->products->count())
      <h2 class="text-xl font-semibold mt-8 mb-3">Products in this Department</h2>
      <ul class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($department->products as $product)
          <li class="border rounded-md p-3 bg-gray-50">
            <a href="{{ route('departments.products.show', [$department, $product]) }}"
               class="font-medium text-purple-700 hover:underline">
               {{ $product->name }}
            </a>
            <p class="text-sm text-gray-600">${{ number_format($product->price, 2) }}</p>
          </li>
        @endforeach
      </ul>
    @else
      <p class="text-gray-600 mt-4">No products found for this department.</p>
    @endif
  </div>
@endsection
