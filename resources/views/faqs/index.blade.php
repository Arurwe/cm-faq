@extends('layouts.app')

@section('title','main page')

@section('content')
    <div class="container">
        <h1>FAQ</h1>
        @livewire('faq-search')
        <ul>
            @foreach($faqs as $faq)
                <li>
                    <a href="{{ route('faqs.show', $faq) }}">{{ $faq->title }}</a>
                </li>
            @endforeach
        </ul>
        {{ $faqs->links() }}
    </div>
@endsection
