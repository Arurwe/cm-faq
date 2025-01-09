@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $faq->title }}</h1>
        <p>{{ $faq->content }}</p>
        <p><strong>Kategoria:</strong> {{ $faq->category->name }}</p>
        <p><strong>Tagi:</strong> {{ $faq->tags->pluck('name')->join(', ') }}</p>
    </div>
@endsection
