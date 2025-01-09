@extends('layouts.app')

@section('title', 'Panel Admina')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold">Panel Admina</h1>
    <ul class="mt-4">
        <li><a href="{{ route('admin.faqs.index') }}" class="text-blue-500 hover:underline">Zarządzaj FAQ</a></li>
        <li><a href="{{ route('admin.categories.index') }}" class="text-blue-500 hover:underline">Zarządzaj kategoriami</a></li>
        <li><a href="{{ route('admin.tags.index') }}" class="text-blue-500 hover:underline">Zarządzaj tagami</a></li>
    </ul>
</div>
@endsection
