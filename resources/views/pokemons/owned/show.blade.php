<x-app-layout class="pt-20 flex flex-col items-center justify-center">
    <x-slot:navLinks>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-secondary-button type="submit" class="md:px-6 md:text-md">Log Out</x-secondary-button>
        </form>
    </x-slot:navLinks>
    <div class="w-[270px] min-h-[270px] max-h-[500px] overflow-y-auto md:w-[400px] border-2 p-2 border-black rounded">
        <div
            class="w-[250px] h-[200px] overflow-y-auto md:w-[380px] border-2 p-2 border-black rounded flex flex-col justify-center items-center">
            <div>
                <img src="{{ $pokemon->basePokemon->sprite_url }}" alt="pokemon" class="h-36">
            </div>
            <h1>{{ $pokemon->basePokemon->name }}</h1>
        </div>
        <div
            class="mt-2 w-[250px] h-[200px] overflow-y-auto md:w-[380px] border-2 p-2 border-black rounded flex flex-col gap-1">
            @if ($pokemon->prevTrainer != null)
                <div class="p-1 flex w-full items-center text-sm border border-black rounded">
                    <h1>Previously Owned by:</h1>
                    <img src="{{ asset($pokemon->prevTrainer->user->avatar_url) }}" class="w-8">
                    <h1>{{ $pokemon->prevTrainer->user->name }}</h1>
                </div>
            @endif
            <div class="p-1 flex w-full items-center text-sm border border-black rounded">
                <h1>Currently Owned by:</h1>
                <img src="{{ asset($pokemon->trainer->user->avatar_url) }}" class="w-8">
                <h1>{{ $pokemon->trainer->user->name }}</h1>
            </div>
            <div class="p-1 flex flex-wrap gap-3 w-full items-center text-sm">
                <h1>Type: {{ $pokemon->basePokemon->type }}</h1>
            </div>
            <div class="p-1 flex flex-wrap gap-3 w-full items-center text-sm">
                <h1>HP: {{ $pokemon->hp }}</h1>
                <h1>ATK: {{ $pokemon->attack }}</h1>
                <h1>DEF: {{ $pokemon->defense }}</h1>
                <h1>SP ATK: {{ $pokemon->special_attack }}</h1>
                <h1>SP DEF: {{ $pokemon->special_defense }}</h1>
                <h1>SPD: {{ $pokemon->speed }}</h1>
                <div class="flex gap-2">
                    <h1>Moves:</h1>
                    <h1>{{ $pokemon->move1 }}</h1>
                    <h1>{{ $pokemon->move2 }}</h1>
                    <h1>{{ $pokemon->move3 }}</h1>
                    <h1>{{ $pokemon->move4 }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="p-2 mt-4 w-[270px] md:w-[400px] flex flex-wrap gap-2 justify-center border-2 border-black rounded">
        <a href="{{ url()->previous() }}" class="w-full"><x-primary-button type="button"
                class="w-full h-12 justify-center">Return</x-primary-button></a>
    </div>
</x-app-layout>
