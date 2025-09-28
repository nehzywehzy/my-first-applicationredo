<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Layout</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex bg-gray-100">
  <!-- Sidebar -->
  <aside class="w-64 bg-white shadow-lg hidden md:flex flex-col">
    <div class="p-6 text-2xl font-bold border-b">My Dashboard</div>
    <nav class="flex-1 p-4 space-y-2">
      <div class="hidden md:block">
        <div class="ml-10 flex items-baseline space-x-4">
          <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
          <x-nav-link href="/jobs" :active="request()->is('jobs')">Jobs</x-nav-link>
        </div>
      </div>
    </nav>
  </aside>

  <!-- Main Content -->
  <div class="flex-1 flex flex-col">
    <!-- Navbar -->
    <header class="h-16 bg-white shadow flex items-center justify-between px-6">
      <button class="md:hidden p-2 rounded bg-gray-200">☰</button>
      <h1 class="text-xl font-semibold">{{ $heading }}</h1>
      <div class="flex items-center space-x-4">
        <span class="text-gray-600">Hello User</span>
        <img src="https://via.placeholder.com/32" class="w-8 h-8 rounded-full" />
      </div>
    </header>

    <!-- Content Area -->
    {{ $slot }}
  </div>
</body>
</html>
