<x-layout>
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-6">Trade Logs</h1>

        <div class="overflow-x-auto bg-white rounded-xl shadow">
            <table class="w-full border-collapse">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="p-3">Sender</th>
                        <th class="p-3">Receiver</th>
                        <th class="p-3">Pokémon</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Date</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($trades as $trade)
                        <tr class="text-center border-b">

                            <!-- Sender -->
                            <td class="p-3">
                                {{ $trade->fromTrainer->user->name ?? 'Unknown' }}
                            </td>

                            <!-- Receiver -->
                            <td class="p-3">
                                {{ $trade->toTrainer->user->name ?? 'Unknown' }}
                            </td>

                            <!-- Offered Pokemon -->
                            <td class="p-3">
                                {{ $trade->offeredPokemon->basePokemon->name ?? 'N/A' }} for {{ $trade->requestedPokemon->basePokemon->name }}
                            </td>

                            <!-- Status -->
                            <td class="p-3 capitalize">
                                {{ $trade->status }}
                            </td>

                            <!-- Date -->
                            <td class="p-3">
                                {{ $trade->created_at->format('M d, Y') }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</x-layout>
