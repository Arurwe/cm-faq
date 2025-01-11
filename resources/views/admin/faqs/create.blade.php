@extends('layouts.admin')

@section('title', 'Dodaj FAQ')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Dodaj nowe FAQ</h1>

    <form action="{{ route('admin.faqs.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        <!-- Ukryte pole na treść z Trix -->
        <input type="hidden" name="content" id="content">
        
        <!-- Tytuł FAQ -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Tytuł</label>
            <input type="text" name="title" id="title" class="mt-1 p-2 w-full border rounded-lg" required>
        </div>

        <!-- Kategoria -->
        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Kategoria</label>
            <select name="category_id" id="category_id" class="mt-1 p-2 w-full border rounded-lg" required>
                <option value="">Wybierz kategorię</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Treść FAQ -->
        <div class="mb-4">
            <label for="trix-editor" class="block text-sm font-medium text-gray-700">Treść</label>
            <trix-editor input="content" id="trix-editor" class="mt-1 h-min-20 p-2 w-full border rounded-lg" required></trix-editor>
        </div>

        <!-- Załączniki -->
        <div class="mb-4">
            <label for="files" class="block text-sm font-medium text-gray-700">Załącz pliki (opcjonalnie)</label>
            <input type="file" name="files[]" id="files" class="mt-1 p-2 w-full border rounded-lg" multiple>
            <p class="text-sm text-gray-500 mt-1">Obsługiwane typy: obrazy, filmy, pliki PDF. Maks. 10MB każdy.</p>
        </div>

        <!-- Przyciski -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Zapisz
            </button>
        </div>
    </form>
</div>
@endsection
