<x-app-layout class="pt-20">

    <x-slot:navLinks>
        <form method="GET" action="{{ route('profile.edit') }}">
            @csrf
            <x-secondary-button type="submit" class="md:px-6 md:text-md">Profile</x-secondary-button>
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-secondary-button type="submit" class="md:px-6 md:text-md">Log Out</x-secondary-button>
        </form>
    </x-slot:navLinks>

    <div class="p-8">

        <h1 class="text-3xl font-bold mb-8">
            Admin Dashboard
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Pokédex -->
            <a href="{{ route('admin.pokedex') }}"
                class="p-6 bg-white border rounded-xl shadow hover:shadow-lg transition text-center">
                <div class="text-3xl mb-2"></div>
                <div class="font-semibold">Complete Pokédex</div>
            </a>

            <!-- Trades -->
            <a href="{{ route('admin.trades') }}"
                class="p-6 bg-white border rounded-xl shadow hover:shadow-lg transition text-center">
                <div class="text-3xl mb-2"></div>
                <div class="font-semibold">Trade Logs</div>
            </a>

            <!-- Trainers -->
            <a href="{{ route('admin.trainers') }}"
                class="p-6 bg-white border rounded-xl shadow hover:shadow-lg transition text-center">
                <div class="text-3xl mb-2"></div>
                <div class="font-semibold">Trainer Profiles</div>
            </a>

        </div>

    </div>
</x-app-layout>
