@extends('layout.app')

@section('content')

  <main class="p-6">
    <div class="min-h-screen p-6">
      <div class="grid grid-cols-12 gap-4">
        <div class="col-span-10 col-start-2">
          <div class="flex justify-between items-center mb-8">
            <div>
              <h1 class="text-2xl font-bold text-gray-900">Usuários</h1>
              <div class="flex items-center text-sm text-gray-500">
                <span>Usuários</span>
                <span class="mx-2">›</span>
                <span>Lista</span>
              </div>
            </div>
            <a href="{{route('dashboard.user.create')}}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md">
              Novo Usuário
            </a>
          </div>

          <!-- Search and Table -->
          <div class="bg-white rounded-lg shadow">
            <div class="p-4 border-b text-right">
              <input
                type="text"
                name="search"
                placeholder="Busque por usuários ..."
                class="w-30 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
              />
            </div>

            <table class="w-full">
              <thead class="bg-gray-50">
                <tr>
                  <th class="w-8 p-4">
                    <input type="checkbox" class="rounded" />
                  </th>
                  <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">
                    Nome
                  </th>
                  <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">
                    E-mail
                  </th>
                  <th class="px-6 py-3 text-right text-sm font-medium text-gray-500">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                @if(count($users))
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="p-4">
                                <input type="checkbox" class="rounded" />
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{$user->name}}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{$user->email}}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('dashboard.user.edit',$user->id) }}" class="text-orange-500 hover:text-orange-600">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                <!-- More rows can be added here -->
              </tbody>
            </table>

            <!-- Pagination -->


            <div class="px-6 py-3 border-t">
                {{$users->links()}}
            </div>
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
