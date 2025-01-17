@extends('layouts.admin')

@section('title', 'Lista kategorii')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Zarządzaj kategoriami</h1>

    <!-- Przycisk dodaj kategorię -->
    <div class="flex justify-start mb-6">
        <a href="{{ route('admin.categories.create') }}" 
           class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition">
            Dodaj kategorię
        </a>
    </div>

    <!-- Tabela kategorii -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="table-auto w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 border-t-2">
                    <th class="px-4 py-2 border text-center text-gray-700">Kolejność
                        <div class="inline-block ml-2">
                            <button onclick="sortTable('order', 'asc')" class="text-gray-500 hover:text-gray-700">
                                ▲
                            </button>
                            <button onclick="sortTable('order', 'desc')" class="text-gray-500 hover:text-gray-700">
                                ▼
                            </button>
                        </div>
                    </th>
                    <th class="px-4 py-2 border text-left text-gray-700">Nazwa
                        <div class="inline-block ml-2">
                            <button onclick="sortTable('name', 'asc')" class="text-gray-500 hover:text-gray-700">
                                ▲
                            </button>
                            <button onclick="sortTable('name', 'desc')" class="text-gray-500 hover:text-gray-700">
                                ▼
                            </button>
                        </div>
                    </th>
                    <th class="px-4 py-2 border text-left text-gray-700">Zdjęcie tła</th>
                    <th class="px-4 py-2 border text-center text-gray-700">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr class="hover:bg-gray-100">
                     <!-- Kolejność -->
                    <td class="px-4 py-2 border text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <!-- Numer kolejności -->
                            <span class="text-lg font-semibold">{{ $category->order }}</span>

                            <!-- Strzałki -->
                            <div class="flex flex-col space-y-1">
                                <!-- Strzałka w górę -->
                                <form action="{{ route('admin.categories.moveUp', $category) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-gray-500 hover:text-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                        </svg>
                                    </button>
                                </form>

                                <!-- Strzałka w dół -->
                                <form action="{{ route('admin.categories.moveDown', $category) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-gray-500 hover:text-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>

                    <!-- Nazwa kategorii -->
                    <td class="px-4 py-2 border">
                        <a href="{{ route('admin.categories.edit', $category) }}" 
                           class="text-blue-500 hover:underline">
                            {{ $category->name }}
                        </a>
                    </td>

                    <!-- Zdjęcie tła -->
                    <td class="px-4 py-2 border">
                        @if ($category->background_image)
                        <img src="{{ asset($category->background_image) }}" alt="Zdjęcie tła" 
                             class="w-24 h-16 object-cover rounded">
                        @else
                        <span class="text-gray-500 italic">Brak zdjęcia</span>
                        @endif
                    </td>

                    <!-- Akcje -->
                    <td class="px-4 py-2 border text-center">
                        <div class="flex justify-center space-x-2">
                            <!-- Zmień zdjęcie -->
                            <a href="{{ route('admin.categories.changeImage', $category) }}" 
                               class="bg-yellow-500 text-white px-3 py-1 rounded shadow hover:bg-yellow-600 transition">
                                Zmień zdjęcie
                            </a>

                            <!-- Usuń -->
                            <form action="{{ route('admin.categories.destroy', $category) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Czy na pewno chcesz usunąć tę kategorię?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 text-white px-3 py-1 rounded shadow hover:bg-red-600 transition">
                                    Usuń
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- JS odpowiedzialny za przesyłanie sortowania do backendu  --}}
<script>
function sortTable(column, direction) {
    const url = new URL(window.location.href);
    url.searchParams.set('sort', column);
    url.searchParams.set('direction', direction);
    window.location.href = url.toString();
}
</script>
@endsection
