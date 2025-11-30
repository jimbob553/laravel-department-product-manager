{{-- Blade Layout: Main Application Layout --}}
{{-- Provides the overall structure for the application pages. --}}



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Bigfoot Bookstore')</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gray-50 text-gray-900 flex flex-col">
  
  <header class="bg-gradient-to-r from-purple-700 via-fuchsia-600 to-yellow-400 text-white">
    <div class="max-w-6xl mx-auto px-4 py-4">
      <a href="{{ route('departments.index') }}"
         class="inline-block text-lg sm:text-xl font-semibold tracking-wide bg-white/10 hover:bg-white/20 transition rounded-xl px-4 py-2 shadow">
        Bigfoot Bookstore
      </a>
    </div>
    @auth
      <p class="text-sm text-white-600">
        Logged in as: <strong>{{ auth()->user()->name }}</strong>
        ({{ auth()->user()->role }})
      </p>
    @endauth
    @auth
      <form method="POST" action="{{ route('logout') }}" class="inline">
      @csrf
      <button type="submit"
              class="bg-orange-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
          Logout
      </button>
      </form>
    @endauth
  </header>
  {{-- Display success message if available --}}
  @if (session('success'))
  <div class="max-w-6xl mx-auto my-4 px-4 py-3 bg-yellow-100 text-purple-800 border border-pink-300 rounded-lg">
    {{ session('success') }}
  </div>
  @endif
  <main class="flex-1">
    <div class="max-w-6xl mx-auto px-4 py-8">
      <main class="p-6">
    
      {{--Where page-specific(ex. create.blade) content will be injected --}}
      @yield('content')
    </div>
  </main>

  
  <footer class="border-t bg-white">
    <div class="max-w-6xl mx-auto px-4 py-6 text-sm">
      <div class="flex items-center gap-2">
        <span class="inline-block h-2 w-2 rounded-full bg-purple-600"></span>
        <span class="text-gray-600">© {{ date('Y') }} Bigfoot Bookstore</span>
      </div>
    </div>
  </footer>
</body>
</html>
