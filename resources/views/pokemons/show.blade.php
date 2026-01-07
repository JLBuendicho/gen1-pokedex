<x-layout>

    <div class="p-10">

        <!-- Back Button -->
        <a href="{{ route('pokemons.index') }}"
           class="inline-block mb-6 text-blue-600 hover:underline">
            ← Back to Pokédex
        </a>

        <!-- Main Card -->
        <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg p-8">

            <!-- Header -->
            <h1 class="text-3xl font-bold mb-6">
                #{{ $pokemon->pokedex_id }} {{ $pokemon->name }}
            </h1>

            <!-- Layout -->
            <div class="flex flex-col md:flex-row gap-8">

                <!-- Image Box (LEFT) -->
                <div class="flex justify-center items-center w-full md:w-1/3">
                    <div class="border rounded-xl p-6 shadow-md bg-slate-50">
                        <img 
                            src="{{ $pokemon->sprite_url }}" 
                            alt="{{ $pokemon->name }}"
                            class="w-48 h-48 object-contain"
                            onerror="this.src='https://img.pokemondb.net/sprites/red-blue/normal/bulbasaur.png';"
                        >
                    </div>
                </div>

                <!-- Info Box (RIGHT) -->
                <div class="flex-1 border rounded-xl p-6 bg-slate-50 shadow-md">
                    <h2 class="text-xl font-semibold mb-4">Pokémon Information</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-lg">
                        <p><strong>Name:</strong> {{ $pokemon->name }}</p>
                        <p><strong>Type:</strong> {{ $pokemon->type ?? 'N/A' }}</p>
                        <p><strong>Min HP:</strong> {{ $pokemon->min_hp ?? 'N/A' }}</p>
                        <p><strong>Max HP:</strong> {{ $pokemon->max_hp ?? 'N/A' }}</p>
                        <p><strong>Min Attack:</strong> {{ $pokemon->min_attack ?? 'N/A' }}</p>
                        <p><strong>Max Attack:</strong> {{ $pokemon->max_attack ?? 'N/A' }}</p>
                        <p><strong>Speed:</strong> {{ $pokemon->max_speed ?? 'N/A' }}</p>
                    </div>
                </div>

            </div>
        </div>

    </div>

</x-layout>
