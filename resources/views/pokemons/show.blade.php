<x-layout>
    <div class="p-10">

        <!-- Back to Pokedex Button -->
        <!-- Back Button -->
        <a href="{{ route('pokemons.index') }}"
            class="inline-flex items-center gap-2 mb-6 px-4 py-2
          bg-white text-gray rounded-sm
          hover:bg-black hover:text-white
          active:translate-y-[1px]
          transition">
            ⬅ Back to Pokédex
        </a>

        <!-- Bottom Navigation -->

        <!-- Previous Button -->
        <div class="absolute inset-x-0 bottom-4 flex justify-between px-8">

            @if ($prevPokemon)
                <a href="{{ route('pokemons.show', $prevPokemon->pokedex_id) }}"
                    class="px-4 py-2 bg-white text-gray
                  bg-white text-gray rounded-sm
                  hover:bg-black hover:text-white
                  active:translate-y-[1px]
                  transition">
                    ← Previous
                </a>
            @endif

            <!-- Next Button -->
            @if ($nextPokemon)
                <a href="{{ route('pokemons.show', $nextPokemon->pokedex_id) }}"
                    class="px-4 py-2 bg-white text-gray
                  rounded-sm 
                  hover:bg-black hover:text-white
                  active:translate-y-[1px]
                  transition">
                    Next →
                </a>
            @endif

        </div>

        <!-- Main Card -->
        <div class="max-w-5xl mx-auto bg-slate-50 rounded-xl shadow-lg p-8">

            <!-- Header -->
            <h1 class="text-3xl font-bold mb-6">
                #{{ $pokemon->pokedex_id }} {{ $pokemon->name }}
            </h1>

            <!-- Layout -->
            <div class="flex flex-col md:flex-row gap-8">

                <!-- Image Box (LEFT) -->
                <div class="flex justify-center items-center w-full md:w-1/3">
                    <div class="border border-slate-200 rounded-xl p-8 shadow-md bg-white w-80 flex justify-center">
                        <img src="{{ $pokemon->sprite_url }}" alt="{{ $pokemon->name }}"
                            class="w-48 h-48 object-contain" <img src="{{ $pokemon->sprite_url }}"
                            alt="{{ $pokemon->name }}" class="w-48 h-48 object-contain"
                            onerror="this.src='https://img.pokemondb.net/sprites/red-blue/normal/bulbasaur.png';">
                    </div>
                </div>

                <!-- Info Box (RIGHT) -->
                <div class="flex-1 border rounded-xl p-6 bg-white shadow-md">
                    <h2 class="text-xl font-semibold mb-4">Pokémon Information</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-lg">
                        <p><strong>Name:</strong> {{ $pokemon->name }}</p>
                        <p><strong>Type:</strong> {{ $pokemon->type ?? 'N/A' }}</p>
                        <p><strong>Min HP:</strong> {{ $pokemon->min_hp ?? 'N/A' }}</p>
                        <p><strong>Max HP:</strong> {{ $pokemon->max_hp ?? 'N/A' }}</p>
                        <p><strong>Min Attack:</strong> {{ $pokemon->min_attack ?? 'N/A' }}</p>
                        <p><strong>Max Attack:</strong> {{ $pokemon->max_attack ?? 'N/A' }}</p>
                        <p><strong>Speed:</strong> {{ $pokemon->max_speed ?? 'N/A' }}</p>
                        <p>
                            <strong>Abilities:</strong>

                            <span class="ml-2">
                                @forelse ($abilities as $ability)
                                    <span class="gap-2 text-lg">
                                        {{ $ability }}
                                    </span>
                                @empty
                                    <span class="text-black">N/A</span>
                                @endforelse
                            </span>
                        </p>

                    </div>
                </div>

            </div>

            <!-- Description -->
            <div class="mt-8 border rounded-xl bg-slate-50 p-6 bg-white shadow-sm">
                <h3 class="text-lg font-semibold mb-3 flex items-center gap-2">
                    🕮 Description
                </h3>

                <p class="text-gray-700 leading-relaxed">
                    {{ $pokemon->description ?? 'No description available for this Pokémon yet.' }}
                </p>
            </div>

            <!-- Evolution Line -->
            <div class="mt-8 border rounded-xl bg-slate-50 p-6 bg-white shadow-sm">
                <h3 class="tex-lg font-semibold mb-3 flex-row items-center gap 2">
                    Evolution Line
                </h3>

                <div class="flex flex-row justify-center items-center gap-6">
                    @foreach ($evolutions as $index => $evolution)
                        <!-- Pokemon Card -->
                        <div class="flex-row items-center">
                            <img src="{{ $evolution->sprite_url }}" alt="{{ $evolution->name }}"
                                class="w-28 h-28 object-contain mb-6"
                                onerror="this.src='https://img.pokemondb.net/sprites/red-blue/normal/bulbasaur.png';">

                            <span class="text-center text-lg font-semibold">
                                {{ $evolution->name }}
                            </span>
                        </div>

                        <!-- Arrow -->
                        @if ($index < count($evolutions) - 1)
                            <div class="text-4xl font-bold text-gray-400 select-none flex-row">
                                →
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Moves -->
            <p>
                <strong>Moves:</strong>

                <span class="ml-2">
                    @forelse ($baseMoves as $move)
                        <span class="inline-block px-2 py-1 mr-2 mb-1">
                            {{ $move }}
                        </span>
                    @empty
                        <span class="text-black">N/A</span>
                    @endforelse
                </span>
            </p>

        </div>
    </div>
</x-layout>
