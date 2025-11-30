@extends('layouts.post')

@section('title', 'Edit Department')

@section('content')
  <div class="max-w-2xl mx-auto bg-white shadow-md rounded-xl p-6">
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl font-bold text-purple-700">Edit Department</h1>
      <a href="{{ route('departments.index') }}" 
         class="text-md bg-pink-400 text-white px-3 py-1.5 rounded hover:bg-pink-700">
         Back to Departments
      </a>
    </div>

    <form method="POST" action="{{ route('departments.update', $department) }}" class="space-y-4">
      @csrf
      @method('PUT')

      <div>
        <label for="name" class="block font-medium text-gray-700">Department Name</label>
        <input type="text" id="name" name="name" 
               value="{{ old('name', $department->name) }}"
               class="mt-1 border rounded-md p-2 w-full focus:ring-purple-400 focus:border-purple-400">
        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="description" class="block font-medium text-gray-700">Description</label>
        <textarea id="description" name="description" rows="3"
                  class="mt-1 border rounded-md p-2 w-full focus:ring-purple-400 focus:border-purple-400">{{ old('description', $department->description) }}</textarea>
        @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <div class="flex gap-3">
        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded">
          Update Department
        </button>

        <a href="{{ route('departments.index') }}" 
           class="text-md bg-gray-300 text-gray-700 px-3 py-1.5 rounded hover:bg-gray-400">
          Cancel
        </a>
      </div>
    </form>
  </div>
@endsection