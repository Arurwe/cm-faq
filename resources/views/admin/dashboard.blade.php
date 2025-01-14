@extends('layouts.admin')

@section('title', 'Panel Admina')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold">Panel Administratora</h1>
    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <a href="{{ route('admin.faqs.index') }}" class="bg-blue-500 text-white p-4 rounded-lg text-center shadow hover:bg-blue-600">
            Zarządzaj FAQ
        </a>
        <a href="{{ route('admin.categories.index') }}" class="bg-green-500 text-white p-4 rounded-lg text-center shadow hover:bg-green-600">
            Zarządzaj kategoriami
        </a>
        <a href="{{ route('admin.users.index') }}" class="bg-cyan-500 text-white p-4 rounded-lg text-center shadow hover:bg-cyan-600">
            Zarządzaj Użytkownika
        </a>
        
    </div>
    <div>
        <p>Ilość wszystkich FAQ: {{ $faqsCount}}</p>
        <p>Ilość odwiedzin wszystkich FAQ: {{ $totalViews }}</p>
        
        <div class=" bg-white shadow-md rounded-lg max-w-72 ">
            <h2>Najczęściej odwiedzane FAQ: </h2>
        <table class=" table-auto max-w-50 border-collapse flex justify-center">
            @foreach ($topFaqs as $topFaq)
            
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-2 border text-center">
                    <a href="{{ route('faq.show', $topFaq)  }}" class="hover:text-blue-300  ">{{ $topFaq->title }}</a>
                </td>
                <td class="px-4 py-2 border text-center">{{ $topFaq->views }}</td>
            
            </tr>
            
            
        @endforeach 
        </table>
    </div>

    <div>
    </div>
    </div>
    

</div>
@endsection
