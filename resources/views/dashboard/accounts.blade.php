@extends('layout.app')

@section('content')
  <main class="p-6">
    <div class="min-h-screen p-6">
      <div class="grid grid-cols-12 gap-4">
        <div class="col-span-10 col-start-2">
          <div class="flex justify-between items-center mb-8">
            <div>
              <h1 class="text-2xl font-bold text-gray-900">Accounts</h1>
              <div class="flex items-center text-sm text-gray-500">
                <span>Accounts</span>
                <span class="mx-2">›</span>
                <span>List</span>
              </div>
            </div>
            <button
              class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md"
            >
              New account
            </button>
          </div>

          <!-- Search and Table -->
          <div class="bg-white rounded-lg shadow">
            <div class="p-4 border-b text-right">
              <input
                type="text"
                placeholder="Search"
                class="w-30 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
              />
            </div>

            <table class="w-full">
              <thead class="bg-gray-50">
                <tr>
                  <th class="w-8 p-4">
                    <input type="checkbox" class="rounded" />
                  </th>
                  <th
                    class="px-6 py-3 text-left text-sm font-medium text-gray-500"
                  >
                    Code
                  </th>
                  <th
                    class="px-6 py-3 text-left text-sm font-medium text-gray-500"
                  >
                    User id
                  </th>
                  <th
                    class="px-6 py-3 text-left text-sm font-medium text-gray-500"
                  >
                    Customer id
                  </th>
                  <th
                    class="px-6 py-3 text-right text-sm font-medium text-gray-500"
                  >
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                <tr class="hover:bg-gray-50">
                  <td class="p-4">
                    <input type="checkbox" class="rounded" />
                  </td>
                  <td class="px-6 py-4 text-sm text-gray-900">
                    876177987375182
                  </td>
                  <td class="px-6 py-4 text-sm text-gray-900">1</td>
                  <td class="px-6 py-4 text-sm text-gray-900">147</td>
                  <td class="px-6 py-4 text-right">
                    <button class="text-orange-500 hover:text-orange-600">
                      Edit
                    </button>
                  </td>
                </tr>
                <tr class="hover:bg-gray-50">
                  <td class="p-4">
                    <input type="checkbox" class="rounded" />
                  </td>
                  <td class="px-6 py-4 text-sm text-gray-900">
                    059730526707338
                  </td>
                  <td class="px-6 py-4 text-sm text-gray-900">1</td>
                  <td class="px-6 py-4 text-sm text-gray-900">104</td>
                  <td class="px-6 py-4 text-right">
                    <button class="text-orange-500 hover:text-orange-600">
                      Edit
                    </button>
                  </td>
                </tr>
                <!-- More rows can be added here -->
              </tbody>
            </table>

            <!-- Pagination -->
            <div
              class="flex items-center justify-between px-6 py-3 border-t"
            >
              <div class="text-sm text-gray-500">
                Showing 1 to 10 of 50,150 results
              </div>
              <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-500">Per page</span>
                <select class="border rounded px-2 py-1">
                  <option>10</option>
                </select>
                <div class="flex space-x-1">
                  <button
                    class="px-3 py-1 rounded border bg-white text-orange-500"
                  >
                    1
                  </button>
                  <button
                    class="px-3 py-1 rounded border hover:bg-gray-50"
                  >
                    2
                  </button>
                  <button
                    class="px-3 py-1 rounded border hover:bg-gray-50"
                  >
                    3
                  </button>
                  <button
                    class="px-3 py-1 rounded border hover:bg-gray-50"
                  >
                    4
                  </button>
                  <span class="px-3 py-1">...</span>
                  <button
                    class="px-3 py-1 rounded border hover:bg-gray-50"
                  >
                    5014
                  </button>
                  <button
                    class="px-3 py-1 rounded border hover:bg-gray-50"
                  >
                    5015
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
      <!-- Stats Cards... (same as before) -->
    </div>
  </main>
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
@endsection
