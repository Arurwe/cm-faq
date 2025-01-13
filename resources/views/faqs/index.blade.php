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
        @if($query !== '')
        <p class="mt-4 mb-4 text-lg text-gray-700 font-medium ">
            Znalezione treści dla: <span class="text-blue-500 font-semibold">{{ $query }}</span>
        </p>
    @endif
    
        <ul class="space-y-4">
            @forelse($faqs as $faq)<a href="{{ route('faq.show', $faq) }}" class=" bg-white shadow-md rounded-lg  hover:bg-gray-100  p-4 block transition-all duration-300">
                        
                <li class="">
                   <p class="font-semibold text-xl text-blue-600 hover:text-blue-800">{{ $faq->title }}</p> 
                    
                    <p class="text-gray-600 mt-2">{{ Str::limit(strip_tags($faq->content, 200)) }}</p>
                </li></a>
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
