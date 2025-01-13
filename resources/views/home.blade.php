@extends('layouts.app')

@section('title','UJ CM FAQ')

@section('content')
<div class="container">


        <div class="mt-8 ">
            <h2 class="text-5xl font-semibold text-center mb-2">Jak możemy pomóc?</h2>
            <p class="justify-center text-center mb-2" >Zacznij pisać pytanie, a wyszukiwarka pomożę znaleźć Ci temat z rozwiązaniem problemu.<br />
            Brak odpowiedniego tematu? <a href="#zglos" class="underline bold-600 hover:text-orange-500">Napisz zgłoszenie</a></p>
            @livewire('faq-search', ['style' => 'main'])
        </div>

        
        <!-- Sekcja kategorii -->
        <div class="mt-8">
            <x-category-list :categories="$categories" style="homePage" />
        </div>


    <div class="mt-8 ">
        <hr class="border-t w-3/4 border-gray-400 mx-auto">
        <h2 class="text-4xl font-semibold text-center mt-2">Najczęściej zadawane pytania</h2>
        <ul class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($mostViewedFaqs as $faq)
                <li class="bg-white shadow-md rounded p-4 mb-4 ml-4 hover:bg-slate-100 group ">
                    <a href="{{ route('faq.show', $faq->id) }}" class="block">
                        <h3 class="text-xl font-semibold text-blue-500 group-hover:text-blue-800 ">{{ $faq->title }}</h3>
                        <p class="text-gray-500 mt-2">{{ Str::limit($faq->content, 100) }}</p>
                        <p class="text-gray-300 mt-2">
                            Liczba wyświetleń: {{ $faq->views }}
                        </p>
                    </a>
                </li>
            @endforeach
            
        </ul>
    </div> 

    <div class="mt-8" id="zglos">
        <hr class="border-t w-3/4 border-gray-400 mx-auto">
        <h2 class="text-2xl font-semibold text-center mt-2 mb-4">Zgłoś problem</h2>
    
        
        <form action="#" method="POST" class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
            
            <!-- Imię -->
            <div class="mb-4">
                <label for="first_name" class="block text-sm font-medium text-gray-700">Imię</label>
                <input type="text" id="first_name" name="first_name" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" required>
            </div>
            
            <!-- Nazwisko -->
            <div class="mb-4">
                <label for="last_name" class="block text-sm font-medium text-gray-700">Nazwisko</label>
                <input type="text" id="last_name" name="last_name" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" required>
            </div>
    
            <!-- Numer telefonu -->
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">Numer telefonu</label>
                <input type="tel" id="phone" name="phone" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" required>
            </div>
    
            <!-- Adres e-mail -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Adres e-mail</label>
                <input type="email" id="email" name="email" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" required>
            </div>
    
           
            <!-- Pole tekstowe -->
            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700">Opisz swój problem</label>
                <textarea id="message" name="message" class="mt-1 p-2 w-full border border-gray-300 rounded-lg h-32" required></textarea>
            </div>

            <!-- Pole do załącznika -->
            <div class="mb-4">
                <label for="attachment" class="block text-sm font-medium text-gray-700">Załącz plik</label>
                <input type="file" id="attachment" name="attachment" class="mt-1 p-2 w-full border border-gray-300 rounded-lg">
            </div>
            
            <!-- Przycisk wysyłania formularza -->
            <div class="flex justify-center">
                <button type="submit" class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600">
                    Wyślij zgłoszenie
                </button>
            </div>
        </form>
    </div>
    

</div>
@endsection
