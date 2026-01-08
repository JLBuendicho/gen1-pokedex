<x-guest-layout>
    <x-slot:message>
        <h1 class="text-center">
            Hey there! You're a new face.<br>Let's get you registered so you can start your Pokémon journey!
        </h1>
    </x-slot:message>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Avatar URL -->
        <div class="flex flex-col items-center">
            <x-input-label for="avatar_url">Choose your Avatar!</x-input-label>
            <input id="avatar_url" type="hidden" name="avatar_url" value="images/trainer0.png">
            <div class="flex gap-1 m-2">
                <button type="button" class="text-2xl px-2 hover:bg-black hover:text-white hover:rounded" onclick="selectAvatar(-1)">⮜</button>
                        <img id="avater_preview" src="{{ asset('images/trainer0.png') }}" alt="avatar" class="h-24">
                <button type="button" class="text-2xl px-2 hover:bg-black hover:text-white hover:rounded" onclick="selectAvatar(1)">⮞</button>
            </div>
            <script>
                const basePath = "{{ asset('images') }}";
                let currentIndex = 0;
                const totalAvatars = 4;

                function selectAvatar(offset) {
                    if ((currentIndex + offset) < 0) {
                        currentIndex = totalAvatars - 1;
                    } else if ((currentIndex + offset) >= totalAvatars) {
                        currentIndex = 0;
                    } else {
                        currentIndex = currentIndex + offset;
                    }

                    document.getElementById('avatar_url').value = `images/trainer${currentIndex}.png`;
                    document.getElementById('avater_preview').src = `${basePath}/trainer${currentIndex}.png`;
                }
            </script>
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
