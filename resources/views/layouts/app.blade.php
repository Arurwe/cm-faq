<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CM FAQ')</title>
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Nagłówek -->
    <header class="bg-white shadow-md fixed top-0 w-full h-16">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold text-blue-500">CM FAQ</a>

            <div class="w-400">
                @livewire('faq-search', ['style' => 'header'])
            </div>

            <nav>
                <ul class="flex space-x-4">
                    <li><a href="{{ route('faqs.index') }}" class="text-gray-700 hover:text-blue-500">FAQ</a></li>
                    <li><a href="{{ route('categories.index') }}" class="text-gray-700 hover:text-blue-500">Kategorie</a></li>
                   <li><a href="{{ route('categories.index') }}" class="text-gray-700 hover:text-blue-500">Zgłoszenie</a></li>
                
                    @auth
                        <li><a href="{{ route('admin.index') }}" class="text-gray-700 hover:text-blue-500">Panel Admina</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-gray-700 hover:text-red-500">Wyloguj</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-500">Zaloguj</a></li>
                    @endauth
                </ul>
            </nav>
        </div>
    </header>

    <!-- Treść dynamiczna -->
    <main class="container mx-auto mt-16 px-4 py-6 h-auto bg-gradient-to-b from-blue-100 to-cyan-0">
        @yield('content')
    </main>

    <!-- Stopka -->
    <footer class="bg-gray-800 text-gray-300 py-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} CM FAQ. Wszystkie prawa zastrzeżone.</p>
            <p>Kontakt: <a href="mailto:xxx@it.pl" class="text-blue-400 hover:underline">xxx@it.pl</a></p>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
