@php
    use App\Models\Trainer;

    $user = auth()->user();
    $trainer = Trainer::where('user_id', $user->id)->first();
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
    <div class="w-[270px] min-h-[270px] md:w-[400px] border-2 p-2 border-black rounded">
        <img id="avater_preview" src="{{ $user->avatar_url }}" alt="avatar" class="w-64 md:w-96">
    </div>
    <div class="p-2 mt-4 w-[270px] md:w-[400px] flex flex-wrap gap-2 justify-center border-2 border-black rounded">
        <a href="{{ route('trainer.explore') }}" class="w-[45%]"><x-primary-button class="w-full h-12 justify-center">Explore</x-primary-button></a>
        <a href="{{ route('trainer.pokedex') }}" class="w-[45%]"><x-primary-button class="w-full h-12 justify-center">PokéDex</x-primary-button></a>
        <a href="{{ route('trainer.show.team') }}" class="w-[45%]"><x-primary-button class="w-full h-12 justify-center">Team</x-primary-button></a>
        <a href="{{ route('trainer.showTradeLobby') }}" class="w-[45%]"><x-primary-button class="w-full h-12 justify-center">Trade</x-primary-button></a>
    </div>
</x-app-layout>
