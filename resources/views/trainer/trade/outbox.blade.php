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
        @foreach ($sentOffers as $sentOffer)
            <div class="md:text-lg mb-2 border-2 border-black rounded p-1 flex justify-between items-center">
                <div class="flex items-center overflow-hidden">
                    <img src="{{ asset($sentOffer->toTrainer->user->avatar_url) }}" alt="avatar" class="w-10">
                    @if ($sentOffer->status === 'rejected')
                        <h1>(rejected)</h1>
                    @elseif ($sentOffer->status === 'accepted')
                        <h1>(accepted)</h1>
                    @endif
                    <h1>{{ $sentOffer->toTrainer->user->name }}</h1>
                </div>
                @if ($sentOffer->status === 'pending')
                    <a href="{{ route('tradeOffer.trainer.show', ['tradeOffer' => $sentOffer]) }}"
                        class="text-sm text-center p-2 bg-white border-2 border-gray-300 rounded hover:bg-gray-100">VIEW
                        OFFER</a>
                @elseif ($sentOffer->status === 'rejected')
                    <form method="POST"
                        action="{{ route('tradeOffer.trainer.resolve', $sentOffer) }}">
                        @csrf
                        @method('put')
                        <x-secondary-button type="submit" class="text-sm p-2 h-12 justify-center">resolve</x-secondary-button>
                    </form>
                @elseif ($sentOffer->status === 'accepted')
                    <form method="POST"
                        action="{{ route('tradeOffer.trainer.resolve', $sentOffer) }}">
                        @csrf
                        @method('put')
                        <x-secondary-button type="submit" class="text-sm p-2 h-12 justify-center">resolve</x-secondary-button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
    <div class="p-2 mt-4 w-[270px] md:w-[400px] flex flex-wrap gap-2 justify-center border-2 border-black rounded">
        <a href="{{ route('trainer.showTradeLobby') }}" class="w-full"><x-primary-button type="button"
                class="w-full h-12 justify-center">Return</x-primary-button></a>
    </div>
</x-app-layout>
