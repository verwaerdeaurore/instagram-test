<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-zinc-200 ">
    <div class="min-h-screen flex flex-col pt-6 sm:pt-0 bg-zinc-200 dark:bg-gray-900 ">
        <div class="container mx-auto flex flex-col space-y-10 w-full">
            <nav class="flex justify-between items-center py-2 bg-zinc-800 w-full">

                <div>
                    <a class="font-bold hover:text-pink-200 transition" href="{{ route('homepage') }}">
                        <x-application-logo
                            class=" w-10 h-10 fill-current text-white group-hover:text-pink-200 transition" />
                    </a>
                </div>
                <div class="flex space-x-4">
                    @if (Route::has('login'))
                        <div>
                            @auth
                                <a href="{{ url('/posts') }}"
                                    class="font-semibold text-white hover:text-pink-100 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Posts</a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="font-semibold text-white hover:text-pink-100 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Se
                                    connecter</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="ml-4 font-semibold text-white hover:text-pink-100 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">S'enregistrer</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </nav>

            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
