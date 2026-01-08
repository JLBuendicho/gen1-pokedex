@php
    use App\Models\Trainer;

    $user = auth()->user();
    $trainer = Trainer::where('user_id', $user->id)->first();
@endphp
<x-app-layout class="flex flex-col items-center justify-center">
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
    <img id="avater_preview" src="{{ $user->avatar_url }}" alt="avatar" class="h-48">
</x-app-layout>
