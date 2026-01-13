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
                <li class="w-[90%] text-center">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="w-[270px] min-h-[270px] max-h-[500px] overflow-y-auto md:w-[400px] border-2 p-2 border-black rounded">
        <div
            class="w-[250px] h-[200px] overflow-y-auto md:w-[380px] border-2 p-2 border-black rounded flex flex-col justify-center">
            <h1>{{ $tradeOffer->fromTrainer->user->name }}'s</h1>
            <div class="flex justify-center">
                <div>
                    <img id="pokemon_preview_A" src="{{ $tradeOffer->offeredPokemon->basePokemon->sprite_url }}"
                        alt="pokemon" class="h-32">
                    <h1 id="pokemon_name_A" class="text-center md:text-xl">
                        {{ $tradeOffer->offeredPokemon->basePokemon->name }}</h1>
                </div>
            </div>
        </div>
        <div
            class="mt-2 w-[250px] h-[200px] overflow-y-auto md:w-[380px] border-2 p-2 border-black rounded flex flex-col justify-center">
            <h1>for {{ $tradeOffer->toTrainer->user->name }}'s</h1>
            <div class="flex justify-center">
                <div>
                    <img id="pokemon_preview_A" src="{{ $tradeOffer->requestedPokemon->basePokemon->sprite_url }}"
                        alt="pokemon" class="h-32">
                    <h1 id="pokemon_name_A" class="text-center md:text-xl">
                        {{ $tradeOffer->requestedPokemon->basePokemon->name }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="p-2 mt-4 w-[270px] md:w-[400px] flex flex-wrap gap-2 justify-center border-2 border-black rounded">
        @if ($trainer->id === $tradeOffer->from_trainer_id)
            <a href="{{ route('tradeOffer.outbox') }}" class="w-full"><x-primary-button type="button"
                    class="w-full h-12 justify-center">Return</x-primary-button></a>
        @endif
        @if ($trainer->id === $tradeOffer->to_trainer_id)
            <form class="flex w-full" method="POST" action="{{ route('tradeOffer.trainer.accept', $tradeOffer) }}">
                @csrf
                @method('put')
                <x-primary-button type="submit" class="w-full h-12 justify-center">Accept</x-primary-button>
            </form>
            <form class="flex w-full" method="POST" action="{{ route('tradeOffer.trainer.reject', $tradeOffer) }}">
                @csrf
                @method('put')
                <x-primary-button type="submit" class="w-full h-12 justify-center">Reject</x-primary-button>
            </form>
            {{-- <a href="" class="w-[45%]"><x-primary-button type="button"
                    class="w-full h-12 justify-center">Counter Offer</x-primary-button></a> --}}
            <a href="{{ route('tradeOffer.inbox') }}" class="w-[95%]"><x-primary-button type="button"
                    class="w-full h-12 justify-center">Return</x-primary-button></a>
        @endif
    </div>
    </form>
</x-app-layout>
