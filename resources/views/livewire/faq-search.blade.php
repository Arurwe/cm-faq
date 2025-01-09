<div>
    <input 
        type="text" 
        wire:model.live="query" 
        placeholder="Szukaj w FAQ..." 
        class="border p-2 w-full"
    />

    @if(strlen($query) > 2)
        <ul class="bg-white shadow-lg mt-2 rounded">
            @forelse($faqs as $faq)
                <li class="p-2 border-b hover:bg-gray-100">
                    <a href="{{ route('faqs.show', $faq) }}">{{ $faq->title }}</a>
                </li>
            @empty
                <li class="p-2">Brak wyników.</li>
            @endforelse
        </ul>
    @endif
</div>