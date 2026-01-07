<x-layout>
    <div class="flex flex-wrap gap-5 p-10 justify-center">
        @foreach ($pokemons as $pokemon)
            <x-cards.a :image="$pokemon->sprite_url">
                <x-slot:header>
                    #{{ $pokemon->pokedex_id }} {{ $pokemon->name }}
                </x-slot:header>
            </x-cards.a>
        @endforeach
    </div>
</x-layout>
