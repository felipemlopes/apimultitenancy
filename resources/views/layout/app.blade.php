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
      <aside
        class="fixed inset-y-0 left-0 bg-white w-64 border-r border-gray-200 z-30 hidden lg:block"
      >
        <!-- Brand -->
        <div class="h-16 flex items-center px-6">
          <span class="text-2xl font-bold text-gray-800">Laravel</span>
        </div>

        <!-- Navigation -->
        <nav class="space-y-1">
          <a
            href="{{ route('dashboard.index') }}"
            class="flex items-center px-6 py-3 text-sm font-medium bg-primary-50 text-primary-700 border-r-4 border-primary-700"
          >
            <svg
              class="w-5 h-5 mr-3"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
              />
            </svg>
            Dashboard
          </a>
          <a
            href="{{route('dashboard.accounts.index')}}"
            class="flex items-center px-6 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900"
          >
            <svg
              class="w-5 h-5 mr-3"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
              />
            </svg>
            Accounts
          </a>
          <a
            href="{{route ('dashboard.accounts.index') }}"
            class="flex items-center px-6 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900"
          >
            <svg
              class="w-5 h-5 mr-3"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
              />
            </svg>
            Customers
          </a>
          <a
            href="#"
            class="flex items-center px-6 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900"
          >
            <svg
              class="w-5 h-5 mr-3"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"
              />
            </svg>
            Orders
          </a>
          <a
            href="#"
            class="flex items-center px-6 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900"
          >
            <svg
              class="w-5 h-5 mr-3"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
              />
            </svg>
            Users
          </a>
        </nav>
      </aside>

      <!-- Main Content -->
      <div class="flex-1 lg:pl-64">
        <!-- Top Bar -->
        <header
          class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 lg:px-8"
        >
          <!-- Page Title -->
          <div class="flex items-center">
            <button
              type="button"
              class="lg:hidden -ml-2 mr-2 p-2 rounded-md text-gray-500 hover:text-gray-600"
            >
              <svg
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"
                />
              </svg>
            </button>
          </div>

          <!-- Right Section -->
          <div class="flex items-center space-x-4 relative">
            <!-- User Profile Dropdown -->
            <div class="relative">
              <button
                id="userMenuButton"
                class="flex items-center space-x-3 focus:outline-none"
              >
                <div
                  class="w-8 h-8 rounded-full bg-black flex items-center justify-center text-white font-semibold"
                >
                  F
                </div>
              </button>

              <!-- Dropdown Menu -->
              <div
                id="userDropdown"
                class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5"
              >
                <div class="px-4 py-2 border-b border-gray-100">
                  <div class="text-sm font-medium text-gray-900">Welcome</div>
                  <div class="text-sm text-gray-500">Nycolas</div>
                </div>
                <a
                  href="#"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center"
                >
                  <svg
                    class="w-4 h-4 mr-2"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                    />
                  </svg>
                  Sign out
                </a>
              </div>
            </div>
          </div>
        </header>

        @yield('content')


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
