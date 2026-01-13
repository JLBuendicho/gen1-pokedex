<x-layout>
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-6">Trainer Profiles</h1>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 border">Name</th>
                        <th class="p-3 border">Pokémons Caught</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trainers as $trainer)
                        <tr class="text-center hover:bg-gray-50">

                            <!-- Avatar + Name -->
                            <td class="p-2 border flex items-center gap-3 justify-center">
                                <img src="{{ asset($trainer->user->avatar_url ?? 'images/default.png') }}"
                                    class="w-10 h-10 rounded-full object-cover border" alt="Avatar">
                                <span>
                                    {{ $trainer->user->name ?? 'Unknown' }}
                                </span>
                            </td>

                            <!-- Pokemons Caught -->
                            <td class="p-2 border">
                                {{ $trainer->pokemons_caught ?: 'None' }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</x-layout>
