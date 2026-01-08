@php
    use App\Models\Trainer;
    use App\Models\BasePokemon;

    $user = auth()->user();
    $trainer = Trainer::where('user_id', $user->id)->first();

    $starterPokemonIDs = ['001', '004', '007'];
    $starterPokemons = [];
    foreach ($starterPokemonIDs as $pid) {
        $starterPokemons[] = BasePokemon::where('pokedex_id', $pid)->first();
    }
@endphp
<x-app-layout class="flex flex-col items-center justify-center pt-10">
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
    <form method="POST" action="{{ route('trainer.updatePokemonsCaught', $trainer) }}">
        @csrf
        @method('PUT')

        <input id="pokemons_caught" type="hidden" name="pokemons_caught" value="001">
        <div class="border-2 px-6 py-4 border-black max-w-[270px] md:max-w-[700px] rounded flex flex-col items-center">
            <h1 class="text-center md:text-xl mt-2">Welcome, {{ $trainer->name }}! Choose your starter Pokémon</h1>
            <div class="flex">
                <button type="button" class="text-2xl px-2 hover:bg-black hover:text-white hover:rounded"
                    onclick="selectPokemon(-1)">⮜</button>
                <div>
                    <img id="pokemon_preview" src="{{ asset('images/prof-oak.png') }}" alt="avatar"
                        class="h-24 md:h-56">
                    <h1 id="pokemon_name" class="text-center md:text-xl"></h1>
                </div>
                <button type="button" class="text-2xl px-2 hover:bg-black hover:text-white hover:rounded"
                    onclick="selectPokemon(1)">⮞</button>
            </div>
        </div>
        <div
            class="p-2 m-4 max-w-[270px] md:max-w-none flex flex-wrap gap-2 justify-center border-2 border-black rounded">
            <x-primary-button type="submit" class="w-28 h-12 md:w-32 justify-center">Choose</x-primary-button>
        </div>
        <script>
            const starterPokemons = @json($starterPokemons);
            console.log(starterPokemons);
            let currentIndex = -1;
            const totalPokemons = 3;

            function selectPokemon(offset) {
                if ((currentIndex + offset) < 0) {
                    currentIndex = totalPokemons - 1;
                } else if ((currentIndex + offset) >= totalPokemons) {
                    currentIndex = 0;
                } else {
                    currentIndex = currentIndex + offset;
                }

                document.getElementById('pokemons_caught').value = starterPokemons[currentIndex].pokedex_id;
                document.getElementById('pokemon_preview').src = starterPokemons[currentIndex].sprite_url;
                document.getElementById('pokemon_name').innerText = starterPokemons[currentIndex].name;
            }
        </script>
    </form>
</x-app-layout>
