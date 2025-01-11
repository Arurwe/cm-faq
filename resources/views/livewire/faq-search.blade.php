{{-- <div>
    <form method="GET" action="{{ route('faqs.index') }}">
        <input 
            name="query"
            type="text" 
            wire:model.live.debounce.500ms="query" 
            placeholder="Szukaj w FAQ..." 
            class="border p-2 rounded-lg
            {{ $style === 'header' ? 'w-80' : 'w-[90%]  content-center' }}"
        />

        <button type="submit" class=" border-solid border-2 border-black rounded-lg p-2  ">
            SZUKAJ
        </button>

    </form>
    @if(strlen($query) > 2)
        <ul class="bg-white shadow-lg mt-2 rounded-lg  z-20 
        {{ $style === 'header' ? 'absolute' : '' }}
         {{ $style === 'header' ? 'w-1/4' : 'w-full' }}">
            @forelse($faqs as $faq)
                <li class="p-2 border-b hover:bg-gray-100">
                    <a href="{{ route('faqs.show', $faq) }}">{{ $faq->title }}</a>
                    <p class="text-gray-600 text-sm">{!! $faq->excerpt !!}</p>
                </li>
            @empty
                <li class="p-2">Brak wyników.</li>
            @endforelse
        </ul>
    @endif
</div> --}}


<div class="flex justify-center items-center mt-1">
    <form method="GET" action="{{ route('faq.index') }}" class="flex w-3/4 max-w-4xl">
        <!-- Pole wyszukiwania -->
        <input 
            name="query"
            type="text" 
            wire:model.live.debounce.500ms="query" 
            placeholder="Szukaj w FAQ..." 
            class="flex-grow border border-gray-300 p-2 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        />

        <!-- Przycisk -->
        <button type="submit" class="bg-blue-500 text-white border border-blue-500 rounded-r-lg px-4 py-2 font-semibold hover:bg-blue-600">
            SZUKAJ
        </button>
    </form>
</div>

<!-- Wyniki wyszukiwania -->
@if(strlen($query) > 2 && count($faqs) > 0)

    <div class="flex justify-center mt-4">
        <ul class="bg-white shadow-lg rounded-lg z-20 w-3/4 max-w-4xl ">
            @foreach($faqs as $faq)
                <li class="p-2 border-b hover:bg-gray-100">
                    <a href="{{ route('faq.show', $faq) }}" class="block">
                        <h3 class="font-bold text-blue-500">{{ $faq->title }}</h3>
                        <p class="text-gray-600 text-sm">{!! $faq->excerpt !!}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif
