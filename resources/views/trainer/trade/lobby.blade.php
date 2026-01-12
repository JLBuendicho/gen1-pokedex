@php
    use App\Models\Trainer;

    $user = auth()->user();
    $trainer = Trainer::where('user_id', $user->id)->first();
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
    <div class="w-[270px] min-h-[270px] max-h-[500px] overflow-y-auto md:w-[400px] border-2 p-2 border-black rounded">
        @foreach ($peers as $peer)
            <div class="md:text-lg mb-2 border-2 border-black rounded p-1 flex justify-between items-center">
                <div class="w-[70%] flex items-center overflow-hidden">
                    <img src="{{ asset($peer->user->avatar_url) }}" alt="avatar" class="w-10 inline-block">
                    {{ $peer->user->name }}
                </div>
                <a href="{{ route('tradeOffer.create', ['peer' => $peer]) }}"
                    class="text-sm text-center bg-white p-2 border-2 border-gray-300 rounded hover:bg-gray-100">OFFER TRADE</a>
            </div>
        @endforeach
    </div>
    <div class="p-2 mt-4 w-[270px] md:w-[400px] flex flex-wrap gap-2 justify-center border-2 border-black rounded">
        <a href="{{ route('tradeOffer.inbox') }}" class="w-full"><x-primary-button type="button"
                class="w-full h-12 justify-center">Inbox</x-primary-button></a>
        <a href="{{ route('tradeOffer.outbox') }}" class="w-full"><x-primary-button
                type="button" class="w-full h-12 justify-center">Outbox</x-primary-button></a>
        <a href="{{ route('dashboard') }}" class="w-full"><x-primary-button type="button"
                class="w-full h-12 justify-center">Return</x-primary-button></a>
    </div>
</x-app-layout>
