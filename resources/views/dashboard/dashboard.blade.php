@extends('layout.app')

@section('content')
    <div class="min-h-screen p-8">
        <!-- Header -->
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
        </header>


        <!-- User Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-4 rounded-lg shadow-sm mb-8 flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                        <span class="text-gray-600"> {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                    <div>
                        <h2 class="font-semibold text-gray-900">Bem vindo</h2>
                        <p class="text-gray-600">{{ Auth::user()->name }}</p>
                    </div>
                </div>
                <a href="{{ route('logout') }}" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">Sair</a>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-sm mb-8 flex justify-between items-center">
                <div class="flex items-center gap-4">

                    <div>
                        <h2 class="font-semibold text-gray-900">API</h2>
                        <p class="text-gray-600">Versão 1.0</p>
                    </div>
                </div>
                <a href="https://documenter.getpostman.com/view/30292747/2sAYHxn4AA" target="blank"
                    class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">Documentação</a>
            </div>
        </div>
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Revenue Card -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-gray-600 mb-2">Sites</h3>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl font-bold text-gray-900">{{ $sites->count() }}</span>

                </div>

            </div>

            <!-- New Customers Card -->


            <!-- New Orders Card -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-gray-600 mb-2">Usuários</h3>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl font-bold text-gray-900"> {{ $users->count() }} </span>

                </div>

            </div>
        </div>
        <div class="bg-white rounded-lg shadow-sm mt-10">
            <!-- Header -->
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Sites mais recentes</h2>
            </div>



            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-200">


                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">

                                Data

                            </th>

                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">
                                Nome

                            </th>




                            <th class="px-6 py-3 text-right text-sm font-medium text-gray-500"><span class="mr-6">Ações
                                </span></th>
            </div>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @if (count($recentSites))
                    @foreach ($recentSites as $recent)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900"> {{ $recent->created_at->format('d/m/Y') }} </td>
                            <td class="px-6 py-4 text-sm text-gray-900"> {{ $recent->name }} </td>

                            <td class="flex space-x-4 justify-end px-6 py-4 text-sm text-gray-900"><a
                                    href="{{ route('dashboard.site.index', ['search' => $recent->name]) }}"
                                    class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">Visualizar</a>
                            </td>



                        </tr>
                    @endforeach
                @else
                @endif

            </tbody>
            </table>
        </div>



    </div>
    </div>


    <script>
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
