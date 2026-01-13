@php
    use App\Models\Pokemon;
    use App\Models\Trainer;

    $user = auth()->user();
    $trainer = Trainer::where('user_id', $user->id)->first();

    function getPokemonsCaughtArray($trainer)
    {
        if (str_contains($trainer->pokemons_caught, '|')) {
            return explode('|', $trainer->pokemons_caught);
        } else {
            return [$trainer->pokemons_caught];
        }
    }

    function getPokemonTeamArray($trainer)
    {
        if (str_contains($trainer->pokemon_team, '|')) {
            return explode('|', $trainer->pokemon_team);
        } else {
            return [$trainer->pokemon_team];
        }
    }

    function getAvailablePokemonsArray($trainer)
    {
        $pokemonsCaught = getPokemonsCaughtArray($trainer);
        $pokemonTeam = getPokemonTeamArray($trainer);
        $availablePokemons = [];

        if (empty($pokemonsCaught) || $pokemonsCaught[0] == '') {
            return [];
        }

        foreach ($pokemonsCaught as $pokemonCaught) {
            if (!in_array($pokemonCaught, $pokemonTeam)) {
                $availablePokemons[] = Pokemon::where('id', $pokemonCaught)->with('basePokemon')->first();
            }
        }

        return $availablePokemons;
    }

    function getPokemonsInTeamArray($trainer)
    {
        $pokemonTeam = getPokemonTeamArray($trainer);
        $pokemonsInTeam = [];

        foreach ($pokemonTeam as $pokemon) {
            $pokemonsInTeam[] = Pokemon::where('id', $pokemon)->with('basePokemon')->first();
        }

        return $pokemonsInTeam;
    }

    $availableTrainerPokemons = getAvailablePokemonsArray($trainer);
    $pokemonsInTeam = getPokemonsInTeamArray($trainer);
@endphp
<x-app-layout class="pt-20 flex flex-col items-center justify-center">
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
    @if (session('success'))
        <h1 class="w-[90%] text-center">{{ session('success') }}</h1>
    @endif
    @if (session('error'))
        <h1 class="w-[90%] text-center">{{ session('error') }}</h1>
    @endif
    @if ($errors->any)
        <ul>
            @foreach ($errors->all() as $error)
                <li class="w-[95%] text-center">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="w-[270px] min-h-[270px] max-h-[500px] overflow-y-auto md:w-[400px] border-2 p-2 border-black rounded">
        <div class="w-[250px] h-[200px] overflow-y-auto md:w-[380px] border-2 p-2 border-black rounded flex flex-wrap items-center">
            @if ($pokemonsInTeam[0] != null)
                @foreach ($pokemonsInTeam as $pokemonInTeam)
                    <a href="{{ route('owned.pokemons.show', ['id' => $pokemonInTeam->id]) }}" class="cursor-pointer">
                        <img id="pokemon_in_team" src="{{ $pokemonInTeam->basePokemon->sprite_url }}" alt="pokemon"
                            class="">
                    </a>
                @endforeach
            @endif
        </div>
        <div
            class="mt-2 w-[250px] h-[200px] overflow-y-auto md:w-[380px] border-2 p-2 border-black rounded flex flex-col justify-center">
            @if (empty($availableTrainerPokemons))
                <p class="text-center">{{ $trainer->user->name }} has no available Pokémons to add to team.</p>
            @else
                <h1>{{ $trainer->user->name }}'s</h1>
                <div class="flex justify-center">
                    <button type="button" class="text-2xl text-bold px-2 hover:bg-black hover:text-white hover:rounded"
                        onclick="selectTrainerPokemon(-1)">
                        <</button>
                    <div>
                        <a id="pokemon_link"
                            href="{{ route('owned.pokemons.show', ['id' => $availableTrainerPokemons[0]->id]) }}"
                            data-template="{{ route('owned.pokemons.show', ['id' => '__ID__']) }}"
                            class="cursor-pointer">
                            <img id="pokemon_preview" src="{{ $availableTrainerPokemons[0]->basePokemon->sprite_url }}"
                                alt="pokemon" class="h-32">
                        </a>
                        <h1 id="pokemon_name" class="text-center md:text-xl">
                            {{ $availableTrainerPokemons[0]->basePokemon->name }}</h1>
                    </div>
                    <button type="button" class="text-2xl text-bold px-2 hover:bg-black hover:text-white hover:rounded"
                        onclick="selectTrainerPokemon(1)">></button>
                </div>
            @endif
        </div>
    </div>
    <div class="p-2 mt-4 w-[270px] md:w-[400px] flex flex-wrap gap-2 justify-center border-2 border-black rounded">
        @if (!empty($availableTrainerPokemons))
            <form method="POST" action="{{ route('trainer.update.team.add') }}" class="flex w-full">
                @csrf
                @method('put')
                <input type="hidden" id="selected_pokemon_id" name="selected_pokemon_id"
                    value="{{ $availableTrainerPokemons[0]->id }}">
                <input type="hidden" id="operation" name="operation" value="add">
                <x-primary-button type="submit" class="w-full h-12 justify-center">Add to Team</x-primary-button>
            </form>
        @else
            <a class="flex px-4 py-2 bg-gray-500 border border-transparent rounded-md text-white uppercase tracking-widest w-full h-12 items-center justify-center cursor-default"
                disabled>Add to Team</a>
        @endif
        <form method="POST" action="{{ route('trainer.clear.team') }}" class="flex w-full">
            @csrf
            @method('put')
            <x-primary-button type="submit" class="w-full h-12 justify-center">Clear Team</x-primary-button>
        </form>
        <a href="{{ route('dashboard') }}" class="w-full"><x-primary-button type="button"
                class="w-full h-12 justify-center">Return</x-primary-button></a>
    </div>
    <script>
        const availableTrainerPokemons = @json($availableTrainerPokemons);
        console.log(availableTrainerPokemons);

        let currentIndex = 0;
        const totalPokemons = availableTrainerPokemons.length;

        const link = document.getElementById('pokemon_link');
        const template = link.dataset.template;

        function updatePokemonDisplay() {
            const pokemon = availableTrainerPokemons[currentIndex];

            document.getElementById('pokemon_preview').src = pokemon.base_pokemon.sprite_url;
            document.getElementById('pokemon_name').innerText = pokemon.base_pokemon.name;
            document.getElementById('selected_pokemon_id').value = pokemon.id;

            // ✅ ALWAYS rebuild from template
            link.href = template.replace('__ID__', pokemon.id);
        }

        function selectTrainerPokemon(offset) {
            currentIndex += offset;

            if (currentIndex < 0) {
                currentIndex = totalPokemons - 1;
            } else if (currentIndex >= totalPokemons) {
                currentIndex = 0;
            }

            updatePokemonDisplay();
        }

        // Ensure correct link on load
        document.addEventListener('DOMContentLoaded', updatePokemonDisplay);
    </script>
</x-app-layout>
