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

    <!-- search moto -->

    <div class="flex justify-center md:justify-end p-2">
        <input id="pokemonSearch" type="text" placeholder="Search Pokémon..."
            class="border rounded-lg px-4 py-2 w-64 focus:outline-none focus:ring focus:ring-blue-300">
    </div>

    <!-- cards -->

    <div id="pokemonGrid" class="flex flex-wrap gap-5 p-10 justify-center">
        @foreach ($pokemons as $pokemon)
            @if (in_array($pokemon->pokedex_id, $uniquePokemonCaughtIds))
                <div class="pokemon-card" data-name="{{ strtolower($pokemon->name) }}"
                    data-id="{{ $pokemon->pokedex_id }}">
                    <x-cards.a :href="route('pokemons.show', ['pokedexId' => $pokemon->pokedex_id])" :image="$pokemon->sprite_url" class="p-4 w-48 hover:shadow-lg">
                        <x-slot:header>
                            {{ $pokemon->pokedex_id }} {{ $pokemon->name }}
                        </x-slot:header>
                    </x-cards.a>
                </div>
            @else
                <div class="pokemon-card" data-name="{{ strtolower($pokemon->name) }}"
                    data-id="{{ $pokemon->pokedex_id }}">
                    <x-cards.basic-card :image="asset('images/missingno.png')" class="p-4 w-48 cursor-default border-gray-300" disabled>
                        <x-slot:header>
                            {{ $pokemon->pokedex_id }} ???
                        </x-slot:header>
                    </x-cards.basic-card>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Script ng Search -->
    <script>
        const searchInput = document.getElementById('pokemonSearch');
        const cards = document.querySelectorAll('.pokemon-card');

        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();

            cards.forEach(card => {
                const name = card.dataset.name;
                const id = card.dataset.id;

                if (name.includes(query) || id.includes(query)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>

</x-app-layout>
