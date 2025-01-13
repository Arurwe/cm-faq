<div class="relative {{ $style === 'header' ? 'z-50' : '' }}">
    <!-- Formularz wyszukiwania -->
    <form method="GET" action="{{ route('faq.index') }}" 
          class="flex {{ $style === 'main' ? 'justify-center items-center w-full' : 'w-full' }}">
        <input 
            name="query"
            type="text" 
            wire:model.live.debounce.500ms="query" 
            placeholder="Szukaj w FAQ..." 
            class="flex-grow border border-gray-300 p-2 
                   {{ $style === 'header' ? 'rounded-lg focus:ring-blue-500 max-w-2xl' : 'rounded-l-lg focus:ring-blue-500 max-w-2xl' }}"
        />
        <button type="submit" class="bg-blue-500 text-white border border-blue-500 
                                     {{ $style === 'header' ? 'rounded-lg' : 'rounded-r-lg px-4 py-2' }} 
                                     font-semibold hover:bg-blue-600">
            SZUKAJ
        </button>
    </form>

    <!-- Wyniki wyszukiwania -->
    @if(strlen($query) > 2)
        <ul class="bg-white shadow-lg mt-2 rounded-lg border border-gray-200 
                  {{ $style === 'header' ? 'absolute w-full z-50' : 'relative w-full' }}">
            @forelse($faqs as $faq)
           
            <li class="p-4 border-b hover:bg-gray-100">
                <a href="{{ route('faq.show', $faq) }}" class="text-blue-500 font-semibold block">
                    {!! str_ireplace($query, "<mark class='bg-yellow-300'>$query</mark>", $faq->title) !!}
                
                <p class="text-gray-600 text-sm">
                    @php
                        $content = $faq->content;
                        $position = mb_stripos($content, $query);
                        if ($position !== false) {
                            $start = max($position - 30, 0); 
                            $style === 'main' ? $length = 150 + mb_strlen($query) : $length= 45 + mb_strlen($query);
                            $excerpt = mb_substr($content, $start, $length);
                            if ($start > 0) {
                                $excerpt = '...' . $excerpt;
                            }
                            if ($start + $length < mb_strlen($content)) {
                                $excerpt .= '...';
                            }

                            // Wyróżnienie wyszukiwanego tekstu
                            $excerpt = str_ireplace($query, "<mark class='bg-yellow-300'>$query</mark>", $excerpt);

                            echo $excerpt;
                        } else {
                            echo Str::limit($content, 100);
                        }
                    @endphp
                </p>
            </a>
            </li>
        
            @empty
                <li class="p-4 text-gray-500">Brak wyników.</li>
            @endforelse
        </ul>
    @endif
</div>
