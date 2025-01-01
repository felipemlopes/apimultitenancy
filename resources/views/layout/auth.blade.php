<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="stylesheet" href="{{asset('assets/dashboard/style.css')}}">
    <script src="https://cdn.tailwindcss.com"></script>

  </head>

  <body class="bg-gray-50">
    <div class="h-full">

      <!-- Main Content -->
      <div class="flex-1">
        <!-- Top Bar -->

        @yield('content')

      </div>
    </div>
  </body>

</html>
