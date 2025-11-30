{{-- Shared Product Form for Create & Edit --}}



<div class="space-y-4">
  {{-- Product Name --}}
  <div>
    <label for="name" class="block font-medium text-gray-700">Product Name</label>
    <input type="text" id="name" name="name"
           value="{{ old('name', $product->name ?? '') }}"
           class="mt-1 border rounded-md p-2 w-full focus:ring-purple-400 focus:border-purple-400">
    @error('name')
      <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
  </div>

  {{-- Price --}}
  {{-- Preserve old input or use product's price if editing --}}
  <div>
    <label for="price" class="block font-medium text-gray-700">Price ($)</label>
    <input type="number" id="price" name="price" step="0.01"   
      value="{{ old('price', $product->price ?? '') }}"
        class="mt-1 border rounded-md p-2 w-full focus:ring-purple-400 focus:border-purple-400">
    {{-- Display validation error for price --}}
    @error('price')
      <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
  </div>

  
  {{-- Description --}}
  <div>
    <label for="description" class="block font-medium text-gray-700">Description</label>
    <textarea id="description" name="description" rows="3"
              class="mt-1 border rounded-md p-2 w-full focus:ring-purple-400 focus:border-purple-400">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description')
      <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
  </div>

  {{-- Image URL --}}
  <div>
    <label for="image_url" class="block font-medium text-gray-700">Image URL</label>
    <input type="url" id="image_url" name="image_url"
           value="{{ old('image_url', $product->image_url ?? '') }}"
           class="mt-1 border rounded-md p-2 w-full focus:ring-purple-400 focus:border-purple-400">
    @error('image_url')
      <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
  </div>

  {{-- Buttons --}}
  <div class="flex gap-3 mt-6">
    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded">
      {{ $buttonText }}
    </button>

    <a href="{{ $product->exists 
            ? route('departments.products.show', [$department, $product]) 
            : route('departments.show', $department) }}"
      class="text-md bg-pink-400 text-white px-3 py-1.5 rounded hover:bg-pink-700">
      Cancel
    </a>
  </div>
</div>
