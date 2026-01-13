<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-mono">
    <div class="h-screen lg:grid lg:grid-cols-3 lg:items-center bg-white">
        <div class="hidden lg:flex lg:flex-col lg:items-center lg:col-span-2 lg-col-start-1">
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="w-[95%] text-center">{{ $error }}</li>
                    @endforeach
                </ul>
            @else
                {{ $message ?? '' }}
            @endif
            <img src="{{ asset('images/prof-oak.png') }}" alt="prof-oak" class="w-64">
        </div>
        <div
            class="lg:rounded-box lg:col-start-3 lg:w-[95%] min-h-screen lg:min-h-[95vh] flex flex-col justify-center items-center pb-20">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="flex flex-col w-[80%] max-w-md">
                <div class="rounded-box w-full px-6 py-4 shadow-md overflow-hidden bg-slate-50 sm:rounded-lg">
                    {{ $slot }}
                </div>
                <a href="/" class="underline hover:text-gray-500">← return to home</a>
            </div>
        </div>
    </div>
</body>

</html>
