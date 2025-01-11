@extends('layouts.admin')

@section('title', 'Zarządzaj użytkownikami')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Lista użytkowników</h1>
    <a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
        Dodaj użytkownika
    </a>

    <table class="mt-6 w-full bg-white shadow-md rounded-lg">
        <thead class="bg-gray-200 text-gray-700">
            <tr>
                <th class="p-4 text-left">Imię</th>
                <th class="p-4 text-left">E-mail</th>
                <th class="p-4 text-left">Admin</th>
                <th class="p-4 text-left">Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="border-b">
                <td class="p-4">{{ $user->name }}</td>
                <td class="p-4">{{ $user->email }}</td>
                <td class="p-4">{{ $user->is_admin ? 'Tak' : 'Nie' }}</td>
                <td class="p-4">
                    <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-500 hover:underline">Edytuj</a>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Usuń</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
</div>
@endsection
