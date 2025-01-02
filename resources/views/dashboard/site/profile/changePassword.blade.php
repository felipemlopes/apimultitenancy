@extends('layout.app')

@section('content')

<!-- Card -->
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg mt-20">
    <h2 class="text-2xl font-semibold text-center mb-4">Alterar Senha</h2>

    <form action="{{ route('dashboard.user.changePassword', $user->id) }}" method="POST">
        @csrf
        <div class="space-y-4">

            <div class="flex flex-col">
                <label for="current_password" class="font-medium text-sm">Senha Atual</label>
                <input
                    type="password"
                    id="current_password"
                    name="current_password"
                    class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"

                />
                @error('current_password')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>


            <div class="flex flex-col">
                <label for="new_password" class="font-medium text-sm">Nova Senha</label>
                <input
                    type="password"
                    id="new_password"
                    name="new_password"
                    class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"

                />
                @error('new_password')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>


            <div class="flex flex-col">
                <label for="new_password_confirmation" class="font-medium text-sm">Confirmar Nova Senha</label>
                <input
                    type="password"
                    id="new_password_confirmation"
                    name="new_password_confirmation"
                    class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"

                />
                @error('new_password_confirmation')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">
                    Alterar Senha
                </button>
            </div>
        </div>
    </form>
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
