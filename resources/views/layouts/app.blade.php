<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'CM FAQ')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-white text-gray-800">

    <!-- Nagłówek -->
    <header class="bg-white shadow-md fixed top-0 w-full h-16 z-50">
        <div class="container mx-auto px-4 py-2 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold text-blue-500">CM FAQ</a>

            <div >
                @livewire('faq-search', ['style' => 'header'])
            </div>

            <nav>
                <ul class="flex space-x-4">
                    <li><a href="{{ route('faq.index') }}" class="text-gray-700 hover:text-blue-500">FAQ</a></li>
                    <li><a href="{{ route('category.index') }}" class="text-gray-700 hover:text-blue-500">Kategorie</a></li>
                    <li><a href="{{ route('category.index') }}" class="text-gray-700 hover:text-blue-500">Zgłoszenie</a></li>
                    @auth
                    <li><form action="{{ route("logout") }}" method="post">@csrf <input class="text-gray-700 hover:text-blue-500" type="submit" value="Wyloguj"></form></li>
                   @else
                   <li><a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-500">ZALOGUJ</a></li>
                   @endauth
                </ul>
            </nav>
        </div>
    </header>

    {{-- Główna część --}}
    
         <main class="container mx-auto mt-12 px-4 py-6 h-auto  bg-blue-50">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} CM FAQ. Wszystkie prawa zastrzeżone.</p>
            <p>Kontakt: <a href="mailto:ok@cm-uj.krakow.pl" class="text-blue-400 hover:underline">ok@cm-uj.krakow.pl </a></p>
        </div>
    </footer>

    @livewireScripts
</body>
</html>