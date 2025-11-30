{{-- Blade Template: Departments Index Page --}}
{{-- Displays a list of all departments with links to their respective product pages. --}}

@extends('layouts.post')
@section('title', 'Departments')

@section('content')
  <div class="mb-6">
    <h1 class="inline-flex items-center gap-2 text-2xl font-semibold tracking-tight
               text-purple-800 bg-yellow-300 px-3 py-1 rounded-xl">
      Departments
      <span class="h-2 w-2 rounded-full bg-purple-700"></span>
    </h1>
  </div>

  {{-- Create button (Admins only) --}}
  @can('create', App\Models\Department::class)
  <div class="flex justify-end mb-4">
    <a href="{{ route('departments.create') }}" 
       class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
      + Add New Department
    </a>
  </div>
  @endcan

  {{-- Department List --}}
  <ul class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
    @forelse ($departments as $dept)
      <li class="odd:bg-purple-50 even:bg-yellow-50 odd:border-purple-200 even:border-yellow-200
                 border rounded-xl group transition">
        {{-- Display each department --}}
        <a
          href="{{ route('departments.show', $dept) }}"
          class="block px-4 py-3 rounded-xl no-underline
                 odd:text-purple-800 even:text-yellow-800
                 hover:underline underline-offset-2
                 odd:hover:bg-purple-100 even:hover:bg-yellow-100
                 focus:outline-none focus-visible:ring-2
                 odd:focus-visible:ring-purple-400 even:focus-visible:ring-yellow-400">
          {{ $dept->name }}
        </a>

        <div class="flex gap-2 px-4 pb-3">
          {{-- Edit visible to Admins + Managers --}}
          @can('update', $dept)
            <a href="{{ route('departments.edit', $dept) }}" 
               class="text-yellow-600 hover:text-yellow-800 hover:underline">
              Edit
            </a>
          @endcan

          {{-- Delete visible to Admins only --}}
          @can('delete', $dept)
            <form method="POST" action="{{ route('departments.destroy', $dept) }}"
                onsubmit="return confirm('Are you sure you want to delete {{ $dept->name }}?')" 
                class="inline-block ml-2">
                @csrf
                @method('DELETE')
              <button type="submit" 
                class="text-sm text-red-600 hover:text-red-800 hover:underline">
                Delete
              </button>
            </form>
          @endcan
        </div>
      </li>
    @empty
      <p class="text-gray-600">No departments yet.</p>
    @endforelse
  </ul>

  {{-- Pagination Links --}}
  <div class="mt-8 flex justify-center">
    {{ $departments->links() }}
  </div>
@endsection
