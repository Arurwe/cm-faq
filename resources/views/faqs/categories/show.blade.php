@extends('layouts.app')

@section('title', 'Kategoria: ' . $category->name)

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-700 mb-6">Kategoria: {{ $category->name }}</h1>

    <ul>
        @forelse ($faqs as $faq)
        <li class="mb-4 border-b pb-4">
            <h2 class="text-lg font-semibold text-blue-500">
                <a href="{{ route('faq.show', $faq) }}">{{ $faq->title }}</a>
            </h2>
            <p class="text-gray-600">{{ Str::limit($faq->content, 250) }}</p>
        </li>
        @empty
        <p>Brak pytań w tej kategorii.</p>
        @endforelse
    </ul>

    <!-- Paginacja -->
    {{ $faqs->links() }}
</div>
@endsection
