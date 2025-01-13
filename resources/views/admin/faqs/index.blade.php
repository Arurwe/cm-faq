@extends('layouts.admin')

@section('title', 'Zarządzaj FAQ')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">FAQ</h1>
    <a href="{{ route('admin.faqs.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Dodaj nowe FAQ</a>

    <table class="table-auto w-full mt-4">
        <thead>
            <tr class="border-t-2">
                <th class="px-4 py-2">Tytuł
                    <div class="inline-block ml-2">
                        <button onclick="sortTable('title', 'asc')" class="text-gray-500 hover:text-gray-700">
                            ▲
                        </button>
                        <button onclick="sortTable('title', 'desc')" class="text-gray-500 hover:text-gray-700">
                            ▼
                        </button>
                    </div>
                </th>
                <th class="px-4 py-2">Kategoria
                    <div class="inline-block ml-2">
                        <button onclick="sortTable('category_name', 'asc')" class="text-gray-500 hover:text-gray-700">
                            ▲
                        </button>
                        <button onclick="sortTable('category_name', 'desc')" class="text-gray-500 hover:text-gray-700">
                            ▼
                        </button>
                    </div>
                </th>
                <th class="px-4 py-2">Opcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($faqs as $faq)
            <tr>
                <td class="border px-4 py-2">{{ $faq->title }}</td>
                <td class="border px-4 py-2">{{ $faq->category->name }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('admin.faqs.edit', $faq) }}" class="text-blue-500">Edytuj</a>
                    <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Usuń</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $faqs->links() }}
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
