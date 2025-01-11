<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

</head>
<body class="bg-gray-100">

    <div class="flex">
        <!-- Menu boczne -->
        <aside class="w-64 bg-blue-800 text-white h-screen shadow-md flex flex-col">
            <div class="p-4 text-2xl font-bold text-center border-b border-blue-700">
                Panel Admina
            </div>
            <nav class="flex flex-col h-screen">
                <ul class="flex-grow space-y-2 mt-4">
                    <li class="border-b border-gray-300">
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-blue-700 rounded">
                            Dashboard
                        </a>
                    </li>
                    <li class="border-b border-gray-300">
                        <a href="{{ route('admin.faqs.index') }}" class="block px-4 py-2 hover:bg-blue-700 rounded">
                            Zarządzaj FAQ
                        </a>
                    </li>
                    <li class="border-b border-gray-300">
                        <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 hover:bg-blue-700 rounded">
                            Zarządzaj kategoriami
                        </a>
                    </li>
                    <li class="border-b border-gray-300">
                        <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 hover:bg-blue-700 rounded">
                            Zarządzaj użytkownikami
                        </a>
                    </li>
                </ul>
                <div class="mt-auto p-4 border-t border-gray-300">
                    <a href="{{ route('home') }}" class="block px-4 py-2 text-center  hover:bg-gray-700 rounded">
                        Powrót na stronę główną
                    </a>
                </div>
            </nav>
            
            {{-- <div class="p-4 border-t border-blue-700">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 rounded text-center">
                        Wyloguj
                    </button>
                </form>
            </div> --}}
        </aside>

        <!-- Główna zawartość -->
        <main class="flex-grow p-6 bg-gray-100">
            <div class="container mx-auto">
                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>

