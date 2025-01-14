<div class="mt-8">
    <hr class="border-t w-3/4 border-gray-400 mx-auto">
    <h2 class="text-4xl font-semibold text-center mt-2 ">Kategorie</h2>
    @if (!request()->is('/'))
        <!-- Przycisk sortowania -->
        <div class="flex justify-center mb-6 space-x-4 mt-6">
            <a href="{{ route('category.index', ['sort' => 'alphabetical']) }}" 
               class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition">
                Sortuj alfabetycznie
            </a>
            <a href="{{ route('category.index', ['sort' => 'order']) }}" 
               class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition">
                Sortuj według ułożenia
            </a>
            <a href="{{ route('category.index', ['sort' => 'faq_count']) }}" 
               class="bg-purple-500 text-white px-4 py-2 rounded-lg shadow hover:bg-purple-600 transition">
                Sortuj po największej liczbie FAQ
            </a>
        </div>
    @endif
    <ul class="mt-4 grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($categories as $category)
            <li 
                class="shadow-md rounded-lg p-4 group h-56 relative bg-cover bg-center hover:shadow-lg"
                style="background-image: url('{{ asset($category->background_image)}}');"
            >
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
        @if($style === "homePage")
        <li 
            class="shadow-md rounded-lg p-4 group h-56 relative bg-cover bg-center hover:shadow-lg"  
            style="background-image: url('{{ asset('/storage/categorybg/all.png')}}');"   >
            <div class="absolute inset-0 bg-black bg-opacity-50 rounded-lg group-hover:bg-opacity-40 transition"></div>
            <!-- Treść kategorii -->
            <a href="{{ route('category.index') }}" class="relative z-10 flex flex-col items-center justify-center text-white text-center h-full">
                <h3 class="text-2xl font-semibold group-hover:text-blue-300">Pokaż wszystkie</h3>
            </a>
        </li>
        @endif
    </ul>
</div>