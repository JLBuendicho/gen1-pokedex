<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $pokemon->name }}</title>
</head>
<body class="p-10">

    <a href="{{ route('pokemons.index') }}">⬅ Back to Pokédex</a>

    <h1 style="font-size: 32px; font-weight: bold;">
        #{{ $pokemon->pokedex_id }} {{ $pokemon->name }}
    </h1>

    <img src="{{ $pokemon->sprite_url }}" width="200">

    <div style="margin-top: 20px;">
        <p><strong>Type:</strong> {{ $pokemon->type ?? 'N/A' }}</p>
        <p><strong>Height:</strong> {{ $pokemon->height ?? 'N/A' }}</p>
        <p><strong>Weight:</strong> {{ $pokemon->weight ?? 'N/A' }}</p>
    </div>

</body>
</html>
