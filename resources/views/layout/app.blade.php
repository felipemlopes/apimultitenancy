<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="stylesheet" href="{{asset('assets/Dashboard/style.css')}}">
    <script src="https://cdn.tailwindcss.com"></script>

  </head>

  <body class="bg-gray-50">


    <div class="flex h-screen">
      <!-- Sidebar -->
      @include('includes.sidebar')
      <!-- Main Content -->
      <div class="flex-1 lg:pl-64">
          @include('includes.header')

          @yield('content')
      </div>
    </div>



    <script>
      // Mobile menu toggle
      document
          .querySelector("button.lg\\:hidden")
          .addEventListener("click", function () {
              const sidebar = document.querySelector("aside");
              sidebar.classList.toggle("hidden");
          });

      // User dropdown toggle
      const userMenuButton = document.getElementById("userMenuButton");
      const userDropdown = document.getElementById("userDropdown");

      userMenuButton.addEventListener("click", function () {
          userDropdown.classList.toggle("active");
      });

      // Close dropdown when clicking outside
      document.addEventListener("click", function (event) {
          if (
              !userMenuButton.contains(event.target) &&
              !userDropdown.contains(event.target)
          ) {
              userDropdown.classList.remove("active");
          }
      });
  </script>


  </body>
</html>
