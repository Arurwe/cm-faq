@extends('layouts.admin')

@section('title', 'Zarządzaj FAQ')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Zarządzaj FAQ</h1>

    <!-- Przycisk dodaj FAQ -->
    <div class="flex justify-start space-x-5 mb-6">
        <a href="{{ route('admin.faqs.create') }}" 
           class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition">
            Dodaj nowe FAQ
        </a>

        <form action="{{ route('admin.faqs.index') }}" method="get">
            @csrf
            <input type="text" name="adminSearchFaq" placeholder="Wyszukaj frazę" value="{{ old('adminSearchFaq', request('adminSearchFaq', '')) }}">
            <button type="submit" class="bg-blue-500 text-white border border-blue-500 font-semibold rounded-r-lg px-4 py-2 hover:bg-blue-600">Szukaj</button>
        </form>
    </div>

    <!-- Tabela FAQ -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="table-auto w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 border-t-2">
                    <!-- Tytuł FAQ -->
                    <th class="px-4 py-2 border text-left text-gray-700">
                        Tytuł
                        <div class="inline-block ml-2">
                            <button onclick="sortTable('title', 'asc')" 
                                    class="text-gray-500 hover:text-gray-700">
                                ▲
                            </button>
                            <button onclick="sortTable('title', 'desc')" 
                                    class="text-gray-500 hover:text-gray-700">
                                ▼
                            </button>
                        </div>
                    </th>

                    <!-- Kategoria -->
                    <th class="px-4 py-2 border text-left text-gray-700">
                        Kategoria
                        <div class="inline-block ml-2">
                            <button onclick="sortTable('category_name', 'asc')" 
                                    class="text-gray-500 hover:text-gray-700">
                                ▲
                            </button>
                            <button onclick="sortTable('category_name', 'desc')" 
                                    class="text-gray-500 hover:text-gray-700">
                                ▼
                            </button>
                        </div>
                    </th>

                    <th class="px-4 py-2 border text-left text-gray-700">
                        Wyświetlenia
                        <div class="inline-block ml-2">
                            <button onclick="sortTable('views', 'asc')" 
                                    class="text-gray-500 hover:text-gray-700">
                                ▲
                            </button>
                            <button onclick="sortTable('views', 'desc')" 
                                    class="text-gray-500 hover:text-gray-700">
                                ▼
                            </button>
                        </div>
                    </th>

                    <!-- Opcje -->
                    <th class="px-4 py-2 border text-center text-gray-700">Opcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($faqs as $faq)
                <tr class="hover:bg-gray-50">
                    <!-- Tytuł FAQ -->
                    <td class="px-4 py-2 border">
                        <a class="hover:text-blue-600" href="{{ route('faq.show', $faq->id) }}">{{ $faq->title }}</a>
                    </td>

                    <!-- Kategoria -->
                    <td class="px-4 py-2 border">
                        {{ $faq->category->name }}
                    </td>

                    <td class="px-4 py-2 border">
                        {{ $faq->views }}
                    </td>

                    <!-- Opcje -->
                    <td class="px-4 py-2 border text-center">
                        <div class="flex justify-center space-x-2">
                            <!-- Edytuj -->
                            <a href="{{ route('admin.faqs.edit', $faq) }}" 
                               class="bg-yellow-500 text-white px-3 py-1 rounded shadow hover:bg-yellow-600 transition">
                                Edytuj
                            </a>

                            <!-- Usuń -->
                            <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" 
                                  onsubmit="return confirm('Czy na pewno chcesz usunąć to FAQ?')"
                                  class="inline-block">
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

    <!-- Paginacja -->
    <div class="mt-6">
        {{ $faqs->links('pagination::tailwind') }}
    </div>
</div>

<!-- JS odpowiedzialny za przesyłanie sortowania do backendu -->
<script>
    function sortTable(column, direction) {
        const url = new URL(window.location.href);
        url.searchParams.set('sort', column);
        url.searchParams.set('direction', direction);
        window.location.href = url.toString();
    }
</script>
@endsection
