@extends('layouts.admin')

@section('title', 'Dodaj kategorie')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Dodaj Kategorie</h1>
    <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">

        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nazwa Kategorii</label>
            <input type="text" name="name" class="mt-1 p-2 w-full border rounded-lg" required>
        </div>

        <div class="mb-4">
            <label for="categoryfile" class="block text-sm font-medium text-gray-700">Zdjęcie tła kategorii</label>
            <input type="file" name="categoryFile" 
            class="p-2 border rounded-lg w-2/3"
            >
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Dodaj
            </button>
        </div>
    </form>
</div>
@endsection