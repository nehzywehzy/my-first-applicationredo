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
  </aside>

  <!-- Main Content -->
  <div class="flex-1 flex flex-col">
    <!-- Navbar -->
    <header class="h-16 bg-white shadow flex items-center justify-between px-6">
      <!-- Left: Title -->
      <h1 class="text-xl font-semibold">Job Listings</h1>

      <!-- Right: Navigation -->
      <nav class="flex items-center space-x-6">
        <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
        <x-nav-link href="/jobs" :active="request()->is('jobs')">Jobs</x-nav-link>
        <x-nav-link href="/contacts" :active="request()->is('contacts')">Contacts</x-nav-link>

        <!-- Create Job Button -->
        <a href="/jobs/create"
           class="ml-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow">
          + Create Job
        </a>
      </nav>
    </header>

    <!-- Content Area -->
    <main class="p-6">
      {{ $slot }}
    </main>
  </div>
</body>
    @include('sweetalert2::index')
</html>


