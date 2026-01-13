@php
    use App\Models\Pokemon;
    use App\Models\Trainer;

    $user = auth()->user();
    $trainer = Trainer::where('user_id', $user->id)->first();

    function getPokemonsCaughtArray($trainerX)
    {
        if (str_contains($trainerX->pokemons_caught, '|')) {
            return explode('|', $trainerX->pokemons_caught);
        } else {
            return [$trainerX->pokemons_caught];
        }
    }

    function getPokemonTeamArray($trainerX)
    {
        if (str_contains($trainerX->pokemon_team, '|')) {
            return explode('|', $trainerX->pokemon_team);
        } else {
            return [$trainerX->pokemon_team];
        }
    }

    function getAvailablePokemonsArray($trainerX)
    {
        $pokemonsCaught = getPokemonsCaughtArray($trainerX);
        $pokemonTeam = getPokemonTeamArray($trainerX);
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

    $trainerAPokemons = getAvailablePokemonsArray($trainer);
    $trainerBPokemons = getAvailablePokemonsArray($peer);
@endphp
<x-app-layout class="pt-20 flex flex-col items-center justify-center">
    <x-slot:navLinks>
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
    <form method="POST" action="{{ route('tradeOffer.store', ['peer' => $peer]) }}">
        @csrf
        <div
            class="w-[270px] min-h-[270px] max-h-[500px] overflow-y-auto md:w-[400px] border-2 p-2 border-black rounded">
            <div
                class="w-[250px] h-[200px] overflow-y-auto md:w-[380px] border-2 p-2 border-black rounded flex flex-col justify-center">
                @if (empty($trainerAPokemons))
                    <p class="text-center">{{ $trainer->user->name }} has no available Pokémon to offer.</p>
                @else
                    <h1>{{ $trainer->user->name }}'s</h1>
                    <div class="flex justify-center">
                        <button type="button"
                            class="text-2xl text-bold px-2 hover:bg-black hover:text-white hover:rounded"
                            onclick="selectTrainerPokemon('A', -1)">
                            <</button>
                        <div>
                            <img id="pokemon_preview_A" src="{{ $trainerAPokemons[0]->basePokemon->sprite_url }}"
                                alt="pokemon" class="h-32">
                            <h1 id="pokemon_name_A" class="text-center md:text-xl">
                                {{ $trainerAPokemons[0]->basePokemon->name }}</h1>
                        </div>
                        <button type="button"
                            class="text-2xl text-bold px-2 hover:bg-black hover:text-white hover:rounded"
                            onclick="selectTrainerPokemon('A', 1)">></button>
                    </div>
                @endif
            </div>
            <div
                class="mt-2 w-[250px] h-[200px] overflow-y-auto md:w-[380px] border-2 p-2 border-black rounded flex flex-col justify-center">
                @if (empty($trainerBPokemons))
                    <p class="text-center">{{ $peer->user->name }} has no available Pokémon to offer.</p>
                @else
                    <h1>for {{ $peer->user->name }}'s</h1>
                    <div class="flex justify-center">
                        <button type="button"
                            class="text-2xl text-bold px-2 hover:bg-black hover:text-white hover:rounded"
                            onclick="selectTrainerPokemon('B', -1)">
                            <</button>
                        <div>
                            <img id="pokemon_preview_B" src="{{ $trainerBPokemons[0]->basePokemon->sprite_url }}"
                                alt="pokemon" class="h-32">
                            <h1 id="pokemon_name_B" class="text-center md:text-xl">
                                {{ $trainerBPokemons[0]->basePokemon->name }}</h1>
                        </div>
                        <button type="button"
                            class="text-2xl text-bold px-2 hover:bg-black hover:text-white hover:rounded"
                            onclick="selectTrainerPokemon('B', 1)">></button>
                    </div>
                @endif
            </div>
            @if (!empty($trainerAPokemons) && !empty($trainerBPokemons))
                <input type="hidden" id="selected_pokemon_A_id" name="selected_pokemon_A_id"
                    value="{{ $trainerAPokemons[0]->id }}">
                <input type="hidden" id="selected_pokemon_B_id" name="selected_pokemon_B_id"
                    value="{{ $trainerBPokemons[0]->id }}">
            @endif
            <script>
                const trainerAPokemons = @json($trainerAPokemons);
                console.log(trainerAPokemons);
                const trainerBPokemons = @json($trainerBPokemons);
                console.log(trainerBPokemons);
                let currentIndexA = 0;
                let currentIndexB = 0;
                const totalAPokemons = trainerAPokemons.length;
                const totalBPokemons = trainerBPokemons.length;

                function selectTrainerPokemon(trainer, offset) {
                    console.log('trainer: ' + trainer);
                    console.log('currentIndexA:' + currentIndexA);
                    console.log('currentIndexB:' + currentIndexB);
                    if (trainer === 'A') {
                        console.log('Selecting A');
                        console.log('offset: ' + offset);
                        if ((currentIndexA + offset) < 0) {
                            currentIndexA = totalAPokemons - 1;
                        } else if ((currentIndexA + offset) >= totalAPokemons) {
                            currentIndexA = 0;
                        } else {
                            currentIndexA = currentIndexA + offset;
                        }
                        console.log('currentIndexA: ' + currentIndexA);

                        console.log(trainerAPokemons[currentIndexA].base_pokemon.sprite_url);
                        console.log('selected_pokemon_A_id: ', trainerAPokemons[currentIndexA].id);
                        document.getElementById('selected_pokemon_A_id').value = trainerAPokemons[currentIndexA].id
                        document.getElementById('pokemon_preview_A').src = trainerAPokemons[currentIndexA].base_pokemon.sprite_url;
                        document.getElementById('pokemon_name_A').innerText = trainerAPokemons[currentIndexA].base_pokemon.name;
                    } else if (trainer === 'B') {
                        console.log('Selecting B');
                        console.log('offset: ' + offset);
                        if ((currentIndexB + offset) < 0) {
                            currentIndexB = totalBPokemons - 1;
                        } else if ((currentIndexB + offset) >= totalBPokemons) {
                            currentIndexB = 0;
                        } else {
                            currentIndexB = currentIndexB + offset;
                        }
                        console.log('currentIndexB: ' + currentIndexB);

                        console.log(trainerBPokemons[currentIndexB].base_pokemon.sprite_url);
                        console.log('selected_pokemon_B_id: ', trainerBPokemons[currentIndexB].id);
                        document.getElementById('selected_pokemon_B_id').value = trainerBPokemons[currentIndexB].id
                        document.getElementById('pokemon_preview_B').src = trainerBPokemons[currentIndexB].base_pokemon.sprite_url;
                        document.getElementById('pokemon_name_B').innerText = trainerBPokemons[currentIndexB].base_pokemon.name;
                    }
                }
            </script>
        </div>
        <div class="p-2 mt-4 w-[270px] md:w-[400px] flex flex-wrap gap-2 justify-center border-2 border-black rounded">
            @if (!empty($trainerAPokemons) && !empty($trainerBPokemons))
                <x-primary-button type="submit" class="w-full h-12 justify-center">Offer Trade</x-primary-button>
            @endif
            <a href="{{ route('trainer.showTradeLobby') }}" class="w-full"><x-primary-button
                    type="button" class="w-full h-12 justify-center">Return</x-primary-button></a>
        </div>
    </form>
</x-app-layout>
