

 @extends('layouts.app')

 @section('title', $faq->title)
 
 @section('content')
 <div class="container mx-auto px-4 py-6">
     <h1 class="text-3xl font-bold mb-6">{{ $faq->title }}</h1>
 
     <!-- Treść FAQ -->
     @if ($faq->file_option === 0)
         <div class="bg-white shadow-md rounded-lg p-6 mb-6">
             {!! $faq->content !!}
         </div>
    @elseif($faq->file_option ===1)
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
    
 
     <!-- Pliki -->
     
         @elseif($faq->file_option === 3)
         @foreach ($faq->files as $file)
             <!-- Opcja 3: Wyświetlanie pliku na stronie -->
             <div class="mb-4">
                 <p>{{ $file->content_before }}</p>
                 @if (Str::endsWith($file->file_path, '.pdf'))
                     <!-- PDF pełny widok -->
                     <iframe toolbar="0" src="{{ asset('storage/' . $file->file_path) }}" class="w-full h-screen"></iframe>
                 @elseif (Str::endsWith($file->file_path, '.ppt') || Str::endsWith($file->file_path, '.pptx'))
                     <!-- Prezentacja NIE DZIAŁA-->
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

     <div class="mt-4 flex items-center space-x-2">
        <a href="{{ route('admin.faqs.edit', $faq->id) }}"  
           class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600 transition">EDYTUJ</a>
        <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" 
              onsubmit="return confirm('Czy na pewno chcesz usunąć ten post?')">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="bg-red-500 text-white px-4 py-2 rounded shadow hover:bg-red-600 transition">USUŃ</button>
        </form>
    </div>
    
    
 </div>
 @endsection
 