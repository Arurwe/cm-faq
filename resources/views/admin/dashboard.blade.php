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
        <a href="{{ route('admin.search-queries') }}" class="bg-cyan-500 text-white p-4 rounded-lg text-center shadow hover:bg-cyan-600">
            Wyszukiwane frazy
        </a>
        
    </div>
    <div>
        <p class="bg-white shadow-md rounded-lg p-5 mt-2 max-w-64 font-semibold">Ilość wszystkich FAQ: {{ $faqsCount}}</p>
        <p class="bg-white shadow-md rounded-lg p-5 mt-2 max-w-80 font-semibold">Ilość odwiedzin wszystkich FAQ: {{ $totalViews }}</p>
        
        <div class=" bg-white shadow-md rounded-lg max-w-80 font-semibold mt-2">
            <h2 class="text-center">Najczęściej odwiedzane FAQ: </h2>
        <table class=" table-auto  border-collapse flex justify-center mt-2 pb-4">
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
    
        <div class="bg-white shadow-md rounded-lg max-w-lg font-semibold mt-2 pl-2 pb-2">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
            <label class="block font-bold mb-2">Wybierz opcję domyślnego wyświetlania <br />Listy kategorii w MainPage</label>
            <div class="space-y-2">
                <label class="inline-flex items-center">
                    <input type="radio" name="categoryDisplayOption" value="order" class="form-radio text-blue-500"
                    {{ $currentOption === 'order' ? 'checked' : '' }}>
                    <span class="ml-2">Według ułożenia</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="categoryDisplayOption" value="faq_count" class="form-radio text-blue-500"
                    {{ $currentOption === 'faq_count' ? 'checked' : '' }}>
                    <span class="ml-2">Ilość postów</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="categoryDisplayOption" value="alphabetic" class="form-radio text-blue-500"
                    {{ $currentOption === 'alphabetic' ? 'checked' : '' }}>
                    <span class="ml-2">Alfabetycznie</span>
                </label>
                <br />
            <button class=" bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600" type="submit">Zapisz</button>
            </div>

        </form>
        
        
        </div>
    </div>
    

</div>
@endsection
