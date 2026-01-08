@php
    use App\Models\Trainer;

    $user = auth()->user();
    $trainer = Trainer::where('user_id', $user->id)->first();
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
    <div class="border-2 p-2 border-black rounded">
        <img id="avater_preview" src="{{ $user->avatar_url }}" alt="avatar" class="h-56 md:h-96">
    </div>
    <div class="p-2 m-4 max-w-[270px] md:max-w-none flex flex-wrap gap-2 justify-center border-2 border-black rounded">
        <a><x-primary-button class="w-28 h-12 md:w-32 justify-center">Explore</x-primary-button></a>
        <a href="{{ route('trainer.pokedex', $trainer) }}"><x-primary-button class="w-28 h-12 md:w-32 justify-center">PokéDex</x-primary-button></a>
        <a><x-primary-button class="w-28 h-12 md:w-32 justify-center">Team</x-primary-button></a>
        <a><x-primary-button class="w-28 h-12 md:w-32 justify-center">Trade</x-primary-button></a>
    </div>
</x-app-layout>
