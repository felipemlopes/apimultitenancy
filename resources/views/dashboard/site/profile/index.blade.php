@extends('layout.app')

@section('content')
  <main class="p-6">
    <div class="min-h-screen p-6">
      <div class="grid grid-cols-12 gap-4">
        <div class="col-span-10 col-start-2">
          <div class="flex justify-between items-center mb-8">
            <div>
              <h1 class="text-2xl font-bold text-gray-900">Perfil</h1>
              <div class="flex items-center text-sm text-gray-500">
                <span>Perfil</span>
                <span class="mx-2">›</span>
                <span>Editar</span>
              </div>
            </div>
          </div>

          <!-- Search and Table -->
          <div class="bg-white rounded-lg shadow w-full">
              <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="{{route('dashboard.profile.update')}}" method="POST">
                  @csrf
                  <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                      Nome
                  </label>
                  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" value="{{Auth::user()->name}}">
                  @error('name')
                  <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                  @enderror
              </div>
              <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                      E-mail
                  </label>
                  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="text" value="{{Auth::user()->email}}">
                  @error('email')
                  <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                  @enderror
              </div>





                  <div class="flex items-center justify-between" >
                      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" style="background: #F97316">
                          Atualizar
                      </button>
                  </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </main>

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
