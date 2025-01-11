@extends('layouts.app')

@section('title', 'Lista kategorii')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-700 mb-6">Kategorie</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($categories as $category)
        <a href="{{ route('category.show', $category) }}">
            <div class="bg-white shadow-md rounded p-4">
                <h2 class="text-xl font-semibold text-blue-500">{{ $category->name }}</h2>
                <p class="text-gray-600 mt-2">
                    {{ $category->faqs_count ?? 0 }} pytań
                </p>
                <div class="mt-4">
                    <span class="inline-block text-blue-500 hover:underline">Zobacz pytania</span>
                </div>
            </div>
        </a>
        
        
        @endforeach
    </div>
</div>
@endsection
