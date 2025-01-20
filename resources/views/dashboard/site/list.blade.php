@extends('layout.app')

@section('content')

    <main class="p-6">
        <div class="min-h-screen p-6">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-10 col-start-2">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Sites</h1>
                            <div class="flex items-center text-sm text-gray-500">
                                <span>Sites</span>
                                <span class="mx-2">›</span>
                                <span>Lista</span>
                            </div>
                        </div>
                        <a href="{{ route('dashboard.site.create') }}"
                            class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md">
                            Novo Site
                        </a>
                    </div>

                    @include('partials.messages')

                    <!-- Search and Table -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b text-right">
                            <form>


                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Busque por sites ..."
                                    class="w-30 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" />
                                <button type="submit"
                                    class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">
                                    Buscar
                                </button>
                            </form>
                        </div>

                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>

                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">
                                        Nome
                                    </th>



                                    <th class="px-6 py-3 text-right text-sm font-medium text-gray-500 ">
                                        <span class="mr-5">Ações</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @if (count($sites))
                                    @foreach ($sites as $site)
                                        <tr class="hover:bg-gray-50">

                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ $site->name }}
                                            </td>

                                            <td class="px-6 py-4 text-right">
                                                <div class="flex space-x-4 justify-end">
                                                    <form action="{{ route('dashboard.site.destroy', $site->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button onclick="confirmDelete(event)" type="submit"
                                                            class="text-red-500 hover:text-red-600 flex items-center"
                                                            aria-label="Excluir Usuário">

                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                class="w-5 h-5 mr-2">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M9 3.75H15M12 6.75V19.5M9.75 6.75H14.25M6.75 6.75H17.25M7.5 10.5V16.5M16.5 10.5V16.5M3.75 6.75H20.25M6 6.75H18M6 6.75V18.75A2.25 2.25 0 008.25 21H15.75A2.25 2.25 0 0018 18.75V6.75H6Z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    <a onclick="confirmKey(event)"
                                                        href="{{ route('dashboard.site.api', $site->id) }}"
                                                        class="text-orange-500 hover:text-orange-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-4 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M18 10.5V7.5a6 6 0 00-12 0v3a3 3 0 00-3 3v7.5a3 3 0 003 3h12a3 3 0 003-3V13.5a3 3 0 00-3-3zm-3 0H9v-3a3 3 0 016 0v3z" />
                                                        </svg>
                                                    </a>
                                                    <a href="{{ route('dashboard.site.edit', $site->id) }}"
                                                        class="text-orange-500 hover:text-orange-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-5 h-5 mr-2 ">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M16.862 3.487a2.25 2.25 0 113.182 3.182l-12 12a4.5 4.5 0 01-2.12 1.178l-4.5 1 1-4.5a4.5 4.5 0 011.178-2.12l12-12z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M10.5 7.5l6 6" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                <!-- More rows can be added here -->
                            </tbody>
                        </table>

                        <!-- Pagination -->


                        <div class="px-6 py-3 border-t">
                            {{ $sites->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>



    <script>
        function confirmKey(event) {

            event.preventDefault(); // Previne o envio automático do formulário
            var urlToRedirect = event.currentTarget.getAttribute('href');

            Swal.fire({
                title: "Você tem certeza?",
                text: "uma nova chave da api será gerada, você não poderá reverter isso!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = urlToRedirect;


                    Swal.fire({
                        title: "Nova chave foi gerada!",
                        text: "",
                        icon: "success"
                    });
                }
            });
        }

        function confirmDelete(event) {
            event.preventDefault(); // Previne o envio automático do formulário

            Swal.fire({
                title: "Você tem certeza?",
                text: "Você não poderá reverter isso!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim, excluir!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submete o formulário se o usuário confirmar
                    event.target.closest('form').submit();
                    Swal.fire({
                        title: "Excluído!",
                        text: "O site foi excluído.",
                        icon: "success"
                    });
                }
            });
        }

        // Mobile menu toggle
        document
            .querySelector("button.lg\\:hidden")
            .addEventListener("click", function() {
                const sidebar = document.querySelector("aside");
                sidebar.classList.toggle("hidden");
            });

        // User dropdown toggle
        const userMenuButton = document.getElementById("userMenuButton");
        const userDropdown = document.getElementById("userDropdown");

        userMenuButton.addEventListener("click", function() {
            userDropdown.classList.toggle("active");
        });

        // Close dropdown when clicking outside
        document.addEventListener("click", function(event) {
            if (
                !userMenuButton.contains(event.target) &&
                !userDropdown.contains(event.target)
            ) {
                userDropdown.classList.remove("active");
            }
        });
    </script>
@endsection
