{{--
  Product Card Component
  Displays individual product details in a card format.--}}
@props(['product'])

<article class="group bg-white rounded-2xl shadow-sm ring-1 ring-gray-200
               hover:shadow-md hover:ring-fuchsia-200 transition">
  <div class="overflow-hidden rounded-t-2xl">
    <img
      src="{{ $product->image_url }}"
      alt="{{ $product->name }}"
      class="w-full aspect-[4/3] object-cover group-hover:scale-[1.02] transition"
      loading="lazy"
      onerror="this.src='https://placehold.co/600x450?text=Image+Unavailable'">
  </div>

  <div class="p-4">
    <h3 class="font-semibold text-gray-900 truncate">{{ $product->name }}</h3>
    <p class="mt-1 text-sm text-gray-600">
      {{-- Limit description to 140 characters --}}
      {{ \Illuminate\Support\Str::limit($product->description, 140) }}
    </p>

    <div class="mt-3 flex items-center justify-between">
      <span class="text-lg font-semibold text-fuchsia-700">
         {{-- Format price to two decimal places --}}
        ${{ number_format($product->price, 2) }}
      </span>
      <span class="text-xs text-gray-400">#{{ $product->item_number }}</span>
    </div>
  </div>
 
 
  {{-- Action Links --}}
<div class="flex gap-3 p-4 border-t">
  {{-- View: everyone --}}
  <a href="{{ route('departments.products.show', [$product->department, $product]) }}" 
     class="text-purple-600 hover:underline">View</a>

  {{-- Edit: only Admin and Manager --}}
  @can('update', $product)
    <a href="{{ route('departments.products.edit', [$product->department, $product]) }}" 
       class="text-yellow-600 hover:underline">Edit</a>
  @endcan

  {{-- Delete: only Admin --}}
  @can('delete', $product)
    <form method="POST" 
          action="{{ route('departments.products.destroy', [$product->department, $product]) }}" 
          onsubmit="return confirm('Are you sure you want to delete this product?')">
      @csrf
      @method('DELETE')
      <button type="submit" class="text-red-600 hover:underline">Delete</button>
    </form>
  @endcan
</div>
</article>
