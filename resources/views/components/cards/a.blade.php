@props(['href' => "", 'image' => null])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'border border-gray-600 rounded w-50 h-50 flex flex-col gap-2 justify-center items-center']) }}>
    @if ($image !== null)
        <img src="{{ $image }}" alt="{{ $header }}" class="w-32">
    @endif
    <h1>{{ $header }}</h1>
    {{ $slot }}
</a>