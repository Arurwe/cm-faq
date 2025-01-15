@extends('layouts.admin')

@section('title', 'Dodaj użytkownika')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Dodaj nowego użytkownika</h1>

    <form action="{{ route('admin.users.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Imię</label>
            <input type="text" name="name" id="name" class="mt-1 p-2 w-full border rounded-lg" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
            <input type="email" name="email" id="email" class="mt-1 p-2 w-full border rounded-lg" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Hasło</label>
            <input type="password" name="password" id="password" class="mt-1 p-2 w-full border rounded-lg" required>
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Potwierdź hasło</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 p-2 w-full border rounded-lg" required>
        </div>
        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="is_admin" class="mr-2">
                <span>admin?</span>
            </label>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            Zapisz
        </button>
    </form>
</div>
@endsection
