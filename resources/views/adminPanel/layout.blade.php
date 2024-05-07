<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="https://beyondco.de/css/default.css">
  @viteReactRefresh
  @vite('resources/js/app.js')
  @vite('resources/css/app.css')
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Windmill Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <script src="{{ asset('js/adminpanel/init-alphine.js') }}"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
  <script src="{{ asset('js/adminpanel/charts-lines.js') }}" defer></script>
  <script src="{{ asset('js/adminpanel/charts-pie.js') }}" defer></script>
</head>

<body>

  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">

    <!-- Sidebar fijo a la izquierda -->
    <div class="z-10 fixed left-0 top-0 h-full">
      @include ('adminPanel.sidebar')
    </div>

    <!-- Contenido principal con margen izquierdo -->
    <div class="z-0 flex flex-col flex-1 ml-64 w-full h-screen overflow-x-hidden">
      @include ('adminPanel.header')
      <main>
        @yield('content')
      </main>
    </div>

  </div>
</body>

</html>