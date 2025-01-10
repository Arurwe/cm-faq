<div>
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
            <svg class="w-6 h-4 text-gray-500 hover:text-blue-500 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16.31 13.25A6.5 6.5 0 1113.25 2a6.5 6.5 0 013.06 11.25z" />
            </svg>
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
</div>