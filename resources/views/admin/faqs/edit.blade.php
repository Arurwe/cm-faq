@extends('layouts.admin')

@section('title', 'Edytuj FAQ')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Edytuj FAQ</h1>

    @if($faq->file_option == 3)
   <h1>UGANDA</h1>

    @else
    <form action="{{ route('admin.faqs.update' ,$faq->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        @method('PUT')
        <!-- Ukryte pole na treść z Trix -->
        <input type="hidden" name="content" id="content" value="{{ old('content', $faq->content) }}">
        
        <!-- Tytuł FAQ -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Tytuł</label>
            <input type="text" name="title" id="title" class="mt-1 p-2 w-full border rounded-lg" value="{{ old('title', $faq->title) }}"required>
        </div>

        <!-- Kategoria -->
        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Kategoria</label>
            <select name="category_id" id="category_id" class="mt-1 p-2 w-full border rounded-lg" required>
                <option value="" >Wybierz kategorię</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $faq->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Treść FAQ -->
        <div class="mb-4">
            <label for="trix-editor" class="block text-sm font-medium text-gray-700">Treść</label>
            <trix-editor input="content" id="trix-editor" class="mt-1 h-min-20 p-2 w-full border rounded-lg" value="{{ old('content', $faq->content) }}" required></trix-editor>
        </div>
<!-- Wyświetlanie załączonych plików -->
<div class="mb-4">
    <label class="block font-medium text-gray-700">Załączone pliki</label>
    <ul class="list-disc pl-5">
        @foreach ($option as $file)
            <li>
                <a href="{{ asset($file->file_path) }}" target="_blank" class="text-blue-500 hover:underline">
                    {{ basename($file->file_path) }} <!-- Nazwa pliku -->
                </a>
                <input type="checkbox" name="remove_files[]" value="{{ $file->id }}"> Usuń
            </li>
        @endforeach
    </ul>
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
    @endif

    
@endsection
