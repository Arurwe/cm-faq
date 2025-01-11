<div class="mt-8">
    <hr class="border-t w-3/4 border-gray-400 mx-auto">
    <h2 class="text-4xl font-semibold text-center mt-2 ">Kategorie</h2>
    <ul class="mt-4 grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($categories as $category)
            <li 
                class="shadow-md rounded-lg p-4 group h-56 relative bg-cover bg-center hover:shadow-lg"
                style="background-image: url('{{ asset($category->background_image)}}');"
            >
                <!-- Overlay dla czytelności tekstu -->
                <div class="absolute inset-0 bg-black bg-opacity-50 rounded-lg group-hover:bg-opacity-40 transition"></div>
                
                <!-- Treść kategorii -->
                <a href="{{ route('category.show', $category) }}" class="relative z-10 flex flex-col items-center justify-center text-white text-center h-full">
                    <h3 class="text-2xl font-semibold group-hover:text-blue-300">{{ $category->name }}</h3>
                    <p class="text-gray-300 mt-2">
                        {{ $category->faqs_count ?? 0 }} pytań
                    </p>
                </a>
            </li>
        @endforeach
    </ul>
</div>