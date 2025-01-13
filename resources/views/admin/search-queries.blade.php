@extends('layouts.admin')

@section('title', 'Wyszukiwane frazy')

@section('content')
<div class="container mx-auto px-4 py-6">
    <form method="get" action="{{ route("admin.search-queries") }}">
        @csrf
        <input type="text" name="adminSearchQueries" placeholder="Wyszukaj frazę" value="{{ old('adminSearchQueries', request('adminSearchQueries', '')) }}">
        <button type="submit">Szukaj</button>
    </form>
    <h1 class="text-2xl font-bold mb-6">Wyszukiwane frazy</h1>

    <table class="table-auto w-full bg-white shadow-md rounded-lg">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2">Fraza
                    <div class="inline-block ml-2">
                        <button onclick="sortTable('query', 'asc')" class="text-gray-500 hover:text-gray-700">
                            ▲
                        </button>
                        <button onclick="sortTable('query', 'desc')" class="text-gray-500 hover:text-gray-700">
                            ▼
                        </button>
                    </div>
                </th>
                <th class="px-4 py-2">Licznik
                    <div class="inline-block ml-2">
                        <button onclick="sortTable('count', 'asc')" class="text-gray-500 hover:text-gray-700">
                            ▲
                        </button>
                        <button onclick="sortTable('count', 'desc')" class="text-gray-500 hover:text-gray-700">
                            ▼
                        </button>
                    </div>
                </th>
                <th class="px-4 py-2">Ostatnia aktualizacja
                    <div class="inline-block ml-2">
                        <button onclick="sortTable('updated_at', 'asc')" class="text-gray-500 hover:text-gray-700">
                            ▲
                        </button>
                        <button onclick="sortTable('updated_at', 'desc')" class="text-gray-500 hover:text-gray-700">
                            ▼
                        </button>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($searchQueries as $query)
                <tr>
                    <td class="border px-4 py-2">{{ $query->query }}</td>
                    <td class="border px-4 py-2">{{ $query->count }}</td>
                    <td class="border px-4 py-2">{{ $query->updated_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
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
