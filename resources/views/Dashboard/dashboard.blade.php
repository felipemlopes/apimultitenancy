@extends('layout.app')

@section('content')
 <!-- Main Content Area -->
 <main class="p-6">
    <!-- Content Header -->
    <div class="flex items-center justify-between mb-6">
      <div>
        <h2 class="text-base font-semibold text-gray-900">Overview</h2>
        <p class="mt-1 text-sm text-gray-500">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci, quibusdam ad cum repellat voluptates at, voluptatum ratione quaerat voluptas aut officiis esse quae natus qui nemo voluptate inventore! Voluptatem, doloremque.
        </p>
      </div>
      <div class="flex items-center space-x-3">

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
