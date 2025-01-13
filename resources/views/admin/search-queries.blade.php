@extends('layouts.admin')

@section('title', 'Wyszukiwane frazy')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Wyszukiwane frazy</h1>

    <table class="table-auto w-full bg-white shadow-md rounded-lg">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2">Fraza</th>
                <th class="px-4 py-2">Licznik</th>
                <th class="px-4 py-2">Ostatnia aktualizacja</th>
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
@endsection
