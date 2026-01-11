<x-layout>

    <!-- Search Box -->
    <div class="flex justify-end p-2 sticky top-16 z-50 bg-white">
        <input id="pokemonSearch" type="text" placeholder="Search Pokémon..."
            class="border rounded-lg px-4 py-2 w-64
                   transition-all duration-300 ease-in-out
                   opacity-100
                   hover:opacity-100 focus:opacity-100">
    </div>

    <!-- Cards -->
    <div id="pokemonGrid" class="flex flex-wrap gap-5 p-10 justify-center">
        @foreach ($pokemons as $pokemon)
            <div class="pokemon-card" data-name="{{ strtolower($pokemon->name) }}" data-id="{{ $pokemon->pokedex_id }}">
                <x-cards.a :href="route('pokemons.show', ['pokedexId' => $pokemon->pokedex_id])" :image="$pokemon->sprite_url" class="p-4 w-48 hover:shadow-lg">
                    <x-slot:header>
                        {{ $pokemon->pokedex_id }} {{ $pokemon->name }}
                    </x-slot:header>
                </x-cards.a>
            </div>
        @endforeach
    </div>

    <!-- Scripts -->
    <script>
        const searchInput = document.getElementById('pokemonSearch');
        const cards = document.querySelectorAll('.pokemon-card');

        /* Search Filter */
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

        /* Fade on Scroll */
        window.addEventListener('scroll', () => {
            if (window.scrollY > 120) {
                searchInput.classList.add('opacity-40');
            } else {
                searchInput.classList.remove('opacity-40');
            }
        });
    </script>

</x-layout>
