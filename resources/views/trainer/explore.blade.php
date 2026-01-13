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
    <div
        class="w-[270px] min-h-[270px] max-h-[500px] flex flex-col justify-center items-center overflow-y-auto md:w-[400px] border-2 p-2 border-black rounded">
        <div>
            <img src="{{ $pokemon->basePokemon->sprite_url }}" alt="pokemon" class="w-36">
        </div>
        <h1>{{ $pokemon->basePokemon->name }}</h1>
    </div>
    <div class="p-2 mt-4 w-[270px] md:w-[400px] flex flex-wrap gap-2 justify-center border-2 border-black rounded">
        <form class="flex w-full" method="POST" action="{{ route('trainer.catch', ['pokemon' => $pokemon]) }}">
            @csrf
            @method('put')
            <x-primary-button type="submit" class="w-full h-12 justify-center">Catch</x-primary-button>
        </form>
        <a href="{{ request()->fullUrl() }}" class="w-full"><x-primary-button type="button"
                class="w-full h-12 justify-center">Run</x-primary-button></a>
        <a href="{{ route('dashboard') }}" class="w-full"><x-primary-button type="button"
                class="w-full h-12 justify-center">Return</x-primary-button></a>
    </div>
</x-app-layout>
