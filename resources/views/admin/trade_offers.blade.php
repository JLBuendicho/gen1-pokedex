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
                    @forelse ($trades as $trade)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-3">{{ $trade->id }}</td>

                            <td class="p-3">
                                {{ $trade->sender->name ?? 'Unknown' }}
                            </td>

                            <td class="p-3">
                                {{ $trade->receiver->name ?? 'Unknown' }}
                            </td>

                            <td class="p-3">
                                {{ $trade->pokemon->name ?? 'N/A' }}
                            </td>

                            <td class="p-3">
                                <span
                                    class="px-2 py-1 rounded text-sm
                                    {{ $trade->status === 'accepted' ? 'bg-green-200 text-green-800' : '' }}
                                    {{ $trade->status === 'pending' ? 'bg-yellow-200 text-yellow-800' : '' }}
                                    {{ $trade->status === 'rejected' ? 'bg-red-200 text-red-800' : '' }}
                                ">
                                    {{ ucfirst($trade->status) }}
                                </span>
                            </td>

                            <td class="p-3">
                                {{ $trade->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-6 text-center text-gray-500">
                                No trades found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
