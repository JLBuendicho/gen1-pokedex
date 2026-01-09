<x-layout>
    <div class="p-4 sm:p-6 lg:p-10">

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

        <!-- Floating Navigation Arrows -->
        <div
            class="fixed inset-y-0 left-0 right-0 
            flex justify-between items-center 
            px-2 sm:px-6 lg:px-12
            pointer-events-none z-40">

            <!-- Previous -->
            <a href="{{ route('pokemons.show', $prevPokemon->pokedex_id) }}"
                class="pointer-events-auto
              flex items-center justify-center
              w-11 h-11 sm:w-14 sm:h-14 lg:w-16 lg:h-16
              rounded-full bg-white/90 border border-black
              shadow-lg hover:bg-black hover:text-white
              transition active:scale-95">
                <span class="text-xl sm:text-3xl lg:text-4xl">‹</span>
            </a>

            <!-- Next -->
            <a href="{{ route('pokemons.show', $nextPokemon->pokedex_id) }}"
                class="pointer-events-auto
              flex items-center justify-center
              w-11 h-11 sm:w-14 sm:h-14 lg:w-16 lg:h-16
              rounded-full bg-white/90 border border-black
              shadow-lg hover:bg-black hover:text-white
              transition active:scale-95">
                <span class="text-xl sm:text-3xl lg:text-4xl">›</span>
            </a>

        </div>

        <!-- Main Card -->
        <div
            class="border-black border-2 bg-slate-50 
            max-w-5xl mx-auto rounded-xl shadow-lg 
            p-4 sm:p-6 lg:p-8">

            <!-- Header -->
            <h1 class="text-3xl font-bold mb-6">
                #{{ $pokemon->pokedex_id }} {{ $pokemon->name }}
            </h1>

            <!-- Layout -->
            <div class="flex flex-col md:flex-row gap-8">

                <!-- Image Box (LEFT) -->
                <div class="flex justify-center items-center w-full md:w-1/3">
                    <div class="border-2 border-black rounded-xl p-8 shadow-md bg-white w-80 flex justify-center">
                        <img src="{{ $pokemon->sprite_url }}" alt="{{ $pokemon->ename }}"
                            class="w-36 h-36 sm:w-48 sm:h-48 object-contain" <img src="{{ $pokemon->sprite_url }}"
                            alt="{{ $pokemon->name }}" class="w-36 h-36 sm:w-48 sm:h-48 object-contain"
                            onerror="this.src='https://img.pokemondb.net/sprites/red-blue/normal/bulbasaur.png';">
                    </div>
                </div>

                <!-- Info Box (RIGHT) -->
                <div class="flex-1 border-2 border-black rounded-xl p-6 bg-white shadow-md">
                    <h2 class="text-xl font-semibold mb-4">Pokémon Information</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 text-base sm:text-lg">
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
            <div class="mt-8 border-2 border-black rounded-xl bg-slate-50 p-6 bg-white shadow-sm">
                <h3 class="text-lg font-semibold mb-3 flex items-center gap-2">
                    🕮 Description
                </h3>

                <p class="text-gray-700 leading-relaxed">
                    {{ $pokemon->description ?? 'No description available for this Pokémon yet.' }}
                </p>
            </div>

            <!-- Evolution Line -->
            <div class="mt-8 border-2 border-black rounded-xl bg-white shadow-sm p-4 sm:p-6">
                <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                    Evolution Line
                </h3>

                <!-- Scroll to see other evolution -->
                <div class="overflow-x-auto">
                    <div
                        class="flex items-center gap-6 sm:gap-10 
                    justify-start sm:justify-center 
                    min-w-max px-2">

                        @foreach ($evolutions as $index => $evolution)
                            <!-- Pokemon -->
                            <div
                                class="flex flex-col items-center 
                            min-w-[90px] sm:min-w-[120px]">

                                <img src="{{ $evolution->sprite_url }}" alt="{{ $evolution->name }}"
                                    class="w-20 h-20 sm:w-28 sm:h-28 object-contain mb-2"
                                    onerror="this.src='https://img.pokemondb.net/sprites/red-blue/normal/bulbasaur.png';">

                                <span class="text-center text-sm sm:text-lg font-semibold">
                                    {{ $evolution->name }}
                                </span>
                            </div>

                            <!-- Arrow -->
                            @if ($index < count($evolutions) - 1)
                                <span
                                    class="mx-2 sm:mx-4 
                                 text-2xl sm:text-4xl 
                                 font-bold text-gray-400 select-none">
                                    →
                                </span>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>


            <!-- Moves -->
            <div class="mt-8 border-2 border-black rounded-xl p-6 bg-white shadow-sm">
                <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                    Moves
                </h3>

                <div class="flex flex-wrap gap-3">
                    @forelse ($baseMoves as $move)
                        <span class="flex items-center px-3 py-1 text-sm font-medium">
                            {{ $move }}
                        </span>
                    @empty
                        <span class="text-black">No moves available.</span>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-layout>
