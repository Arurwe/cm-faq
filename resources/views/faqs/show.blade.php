{{-- @extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6 px-4">
        <!-- Nagłówek tytułu FAQ -->
        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $faq->title }}</h1>
        
        <!-- Treść FAQ -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            {!! $faq->content !!}
           
            
        </div>

        <!-- Informacje o kategorii -->
        <div class="flex items-center space-x-4 mb-4">
            <p class="text-sm text-gray-600"><strong>Kategoria:</strong><a class="hover:text-blue-500"href="{{ route('category.show',$faq->category) }}"> {{ $faq->category->name }}</a></p>
        </div>

        <!-- Tagi -->
        @if($faq->tags->count() > 0)
            <div class="flex flex-wrap items-center space-x-3">
                <strong class="text-sm text-gray-600">Tagi:</strong>
                @foreach($faq->tags as $tag)
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">{{ $tag->name }}</span>
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-600 mt-2">Brak tagów.</p>
        @endif

        {{-- Wyświetlenia --}}
        {{-- <p class="text-sm text-gray-600 mt-2">Ilość wyświetleń: {{ $faq->views }}</p>
    </div>
@endsection
 --}} 


 @extends('layouts.app')

 @section('title', $faq->title)
 
 @section('content')
 <div class="container mx-auto px-4 py-6">
     <h1 class="text-3xl font-bold mb-6">{{ $faq->title }}</h1>
 
     <!-- Treść FAQ -->
     @if ($faq->file_option === 1)
         <div class="bg-white shadow-md rounded-lg p-6 mb-6">
             {!! $faq->content !!}
         </div>
         @foreach ($faq->files as $file)
         <div class="mb-4">
            <p>{{ $file->content_before }} <a href="{{ asset('storage/' . $file->file_path) }}" 
                download 
                class="text-blue-500 hover:underline">Pobierz plik</a>
            </p>
        </div>
         @endforeach
     @endif
 
     <!-- Pliki -->
     
         @if($faq->file_option === 3)
         @foreach ($faq->files as $file)
12212
             <!-- Opcja 3: Wyświetlanie pliku na stronie -->
             <div class="mb-4">
                 <p>{{ $file->content_before }}</p>
                 @if (Str::endsWith($file->file_path, '.pdf'))
                     <!-- PDF pełny widok -->
                     <iframe toolbar="0" src="{{ asset('storage/' . $file->file_path) }}" class="w-full h-screen"></iframe>
                 @elseif (Str::endsWith($file->file_path, '.ppt') || Str::endsWith($file->file_path, '.pptx'))
                     <!-- Prezentacja -->
                     <object data="https://docs.google.com/gview?url={{ asset('storage/' . $file->file_path) }}&embedded=true" type="application/pdf" class="w-full h-screen">
                        <p>Twoja przeglądarka nie obsługuje wyświetlania plików PowerPoint.</p>
                    </object>
                    <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode(asset('storage/' . $file->file_path)) }}" width="100%" height="100%" frameborder="0"> </iframe>
                 @endif
             </div>
             @endforeach
         @endif
  
 
     <!-- Informacje o kategorii -->
     <div class="flex items-center space-x-4 mb-4">
         <p class="text-sm text-gray-600">
             <strong>Kategoria:</strong>
             <a class="hover:text-blue-500" href="{{ route('category.show', $faq->category) }}">
                 {{ $faq->category->name }}
             </a>
         </p>
     </div>
 
     <!-- Wyświetlenia -->
     <p class="text-sm text-gray-600 mt-2">Ilość wyświetleń: {{ $faq->views }}</p>
 </div>
 @endsection
 