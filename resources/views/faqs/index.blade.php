@extends('layouts.app')

@section('title', 'Wyniki')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Nagłówek -->
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Wyniki wyszukiwania FAQ</h1>

        <!-- Livewire Search -->
        <div class="mb-6">
            @livewire('faq-search', ['style' => 'main'])
        </div>

        <!-- Lista wyników -->
        <ul class="space-y-4">
            @forelse($faqs as $faq)
                <li class="bg-white shadow-md rounded-lg p-4 hover:bg-gray-100 transition-all duration-300">
                    <a href="{{ route('faqs.show', $faq) }}" class="underline text-xl font-semibold text-blue-600 hover:text-blue-800">
                        {{ $faq->title }}
                    </a>
                    <p class="text-gray-600 mt-2">{{ Str::limit($faq->content, 120) }}</p>
                </li>
            @empty
                <li class="bg-white shadow-md rounded-lg p-4">
                    <p class="text-gray-500">Brak wyników dla tego zapytania.</p>
                </li>
            @endforelse
        </ul>

        <!-- Paginacja -->
        <div class="mt-6">
            {{ $faqs->links() }}
        </div>
    </div>
@endsection
