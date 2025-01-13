@extends('layouts.admin')

@section('title', 'Lista kategorii')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-700 mb-6">Zarządzaj kategoriami</h1>

    <!-- Przycisk dodaj kategorię -->
    <div class="flex justify-end mb-6">
        <a href="{{ route('admin.categories.create') }}" 
           class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition">
            Dodaj kategorię
        </a>
    </div>

    <!-- Tabela kategorii -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="table-auto w-full border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border text-left text-gray-700">Nazwa</th>
                    <th class="px-4 py-2 border text-left text-gray-700">Zdjęcie tła</th>
                    <th class="px-4 py-2 border text-center text-gray-700">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr class="hover:bg-gray-50">
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
@endsection
