@extends('layouts.admin')

@section('title', 'Zarządzaj FAQ')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">FAQ</h1>
    <a href="{{ route('admin.faqs.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Dodaj nowe FAQ</a>
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">Tytuł</th>
                <th class="px-4 py-2">Kategoria</th>
                <th class="px-4 py-2">Opcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($faqs as $faq)
            <tr>
                <td class="border px-4 py-2">{{ $faq->title }}</td>
                <td class="border px-4 py-2">{{ $faq->category->name }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('admin.faqs.edit', $faq) }}" class="text-blue-500">Edytuj</a>
                    <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Usuń</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $faqs->links() }}
</div>
@endsection
