{{-- @extends('layouts.admin')

@section('title', 'Dodaj FAQ')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Dodaj nowe FAQ</h1>

    <form action="{{ route('admin.faqs.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        <!-- Ukryte pole na treść z Trix -->
        <input type="hidden" name="content" id="content">
        
        <!-- Tytuł FAQ -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Tytuł</label>
            <input type="text" name="title" id="title" class="mt-1 p-2 w-full border rounded-lg" required>
        </div>

        <!-- Kategoria -->
        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Kategoria</label>
            <select name="category_id" id="category_id" class="mt-1 p-2 w-full border rounded-lg" required>
                <option value="">Wybierz kategorię</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Treść FAQ -->
        <div class="mb-4">
            <label for="trix-editor" class="block text-sm font-medium text-gray-700">Treść</label>
            <trix-editor input="content" id="trix-editor" class="mt-1 h-min-20 p-2 w-full border rounded-lg" required></trix-editor>
        </div>

        <!-- Załączniki -->
        <div class="mb-4">
            <label for="files" class="block text-sm font-medium text-gray-700">Załącz pliki (opcjonalnie)</label>
            <input type="file" multiple name="files[]" class="mt-1 p-2 w-full border rounded-lg" onchange="handleFileSelect(event)">
            <p class="text-sm text-gray-500 mt-1">Obsługiwane typy: obrazy, filmy, pliki PDF. Maks. 10MB każdy.</p>

            <!-- Kontener plików i opcji -->
            <div id="file-container"></div>
        </div>

        <!-- Przyciski -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Zapisz
            </button>
        </div>
    </form>
</div>

<script>
   function handleFileSelect(event) {
    const fileInput = event.target;
    const fileContainer = document.getElementById('file-container');
    
    const fileInputWrapper = document.createElement('div');
    fileInputWrapper.classList.add('flex', 'items-center', 'mb-2');
    
    const fileName = document.createElement('span');
    fileName.classList.add('mr-2');
    fileName.textContent = fileInput.files[0].name;  // Nazwa wybranego pliku
    
    const fileOptionInput = document.createElement('input');
    fileOptionInput.type = 'text';
    fileOptionInput.name = 'file_option[]';
    fileOptionInput.classList.add('mt-1', 'p-2', 'w-full', 'border', 'rounded-lg', 'ml-2');
    fileOptionInput.placeholder = 'Wpisz tekst, który będzie przed załącznikiem';

    const removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.classList.add('text-red-500', 'ml-2');
    removeButton.textContent = 'Usuń';
    removeButton.onclick = function () {
        fileInputWrapper.remove();
    };

    fileInputWrapper.appendChild(fileName);
    fileInputWrapper.appendChild(fileOptionInput);
    fileInputWrapper.appendChild(removeButton);
    
    fileContainer.appendChild(fileInputWrapper);
}

</script>

@endsection --}}


@extends('layouts.admin')

@section('title', 'Dodaj FAQ')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Zarządzanie FAQ</h1>

    <!-- Zakładki -->
    <div class="mb-4">
        <div class="flex border-b">
            <button id="tab-faq" class="px-4 py-2 text-blue-500 font-bold border-b-2 border-blue-500 focus:outline-none" onclick="switchTab('faq')">
                Dodaj FAQ
            </button>
            <button id="tab-category" class="px-4 py-2 text-gray-500 hover:text-blue-500 focus:outline-none" onclick="switchTab('category')">
                Dodaj Faq jako Plik
            </button>
        </div>
    </div>

    <!-- Zakładka: Dodaj FAQ -->
    <div id="faq-tab" class="tab-content">
        <form action="{{ route('admin.faqs.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            <!-- Ukryte pole na treść z Trix -->
            <input type="hidden" name="content" id="content">
            <input type="hidden" value="2" name="faqTypePost">
            <!-- Tytuł FAQ -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Tytuł</label>
                <input type="text" name="title" id="title" class="mt-1 p-2 w-full border rounded-lg" required>
            </div>

            <!-- Kategoria -->
            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Kategoria</label>
                <select name="category_id" id="category_id" class="mt-1 p-2 w-full border rounded-lg" required>
                    <option value="">Wybierz kategorię</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Treść FAQ -->
            <div class="mb-4">
                <label for="trix-editor" class="block text-sm font-medium text-gray-700">Treść</label>
                <trix-editor input="content" id="trix-editor" class="mt-1 h-min-20 p-2 w-full border rounded-lg" required></trix-editor>
            </div>

            <!-- Załączniki -->
            <div class="mb-4">
                <label for="files" class="block text-sm font-medium text-gray-700">Załącz pliki (opcjonalnie)</label>
                <div id="file-inputs">
                    <!-- Dynamicznie dodawane inputy -->
                    <div class="flex items-center mb-2">
                        <input type="file" name="files[]" class="p-2 border rounded-lg w-2/3" onchange="addFileInput()">
                        <input type="text" name="file_descriptions[]" placeholder="Co ma być wyświetlane przed" class="ml-2 p-2 border rounded-lg w-1/3">
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-1">Obsługiwane typy: obrazy, filmy, pliki PDF. Maks. 10MB każdy.</p>
            </div>

            <!-- Przyciski -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Zapisz
                </button>
            </div>
        </form>
    </div>

    <!-- Zakładka: Dodaj Faq jako Plik -->
    <div id="category-tab" class="tab-content hidden">
        <form action="{{ route('admin.faqs.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            <input type="hidden" value="1" name="faqTypePost">
            <!-- Tytuł FAQ -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Tytuł</label>
                <input type="text" name="title" id="title" class="mt-1 p-2 w-full border rounded-lg" required>
            </div>

            <!-- Kategoria -->
            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Kategoria</label>
                <select name="category_id" id="category_id" class="mt-1 p-2 w-full border rounded-lg" required>
                    <option value="">Wybierz kategorię</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Opis -->
            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Opis</label>
                <input type="text" name="faqDescription" class="mt-1 p-2 w-full border rounded-lg">
            </div>
    
            <!-- Plik -->
            <div class="mb-4">
                <label for="faqfile" class="block text-sm font-medium text-gray-700">Dodaj plik (PDF lub Prezentacja)</label>
                <input 
                    type="file" 
                    name="faqfile" 
                    id="faqfile" 
                    class="mt-1 p-2 w-full border rounded-lg" 
                    accept=".pdf,.ppt,.pptx" 
                    required>
                <p class="text-sm text-gray-500 mt-1">Obsługiwane formaty: PDF, PPT, PPTX. Maks. 10MB.</p>
            </div>
    
            <!-- Przyciski -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Dodaj Faq w formie pliku
                </button>
            </div>
        </form>
    </div>
    
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

</div>

<script>
    function switchTab(tab) {
        // Ukryj wszystkie zakładki
        document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));

        // Pokaż wybraną zakładkę
        document.getElementById(tab + '-tab').classList.remove('hidden');

        // Zmień styl aktywnej zakładki
        document.querySelectorAll('button[id^="tab-"]').forEach(btn => {
            btn.classList.remove('text-blue-500', 'border-blue-500', 'font-bold');
            btn.classList.add('text-gray-500');
        });
        document.getElementById('tab-' + tab).classList.add('text-blue-500', 'border-blue-500', 'font-bold');
    }

    function addFileInput() {
    const container = document.getElementById('file-inputs');
    const lastInput = container.lastElementChild.querySelector('input[type="file"]');
    if (lastInput && lastInput.value === "") {
        alert("Najpierw wybierz plik przed dodaniem nowego pola.");
        return;
    }
    const newInput = `
        <div class="flex items-center mb-2">
            <input type="file" name="files[]" class="p-2 border rounded-lg w-2/3">
            <input type="text" name="file_descriptions[]" placeholder="Co ma być wyświetlane przed" class="ml-2 p-2 border rounded-lg w-1/3">
            <button type="button" class="text-red-500 ml-2" onclick="this.parentElement.remove()">Usuń</button>
        </div>`;
    container.insertAdjacentHTML('beforeend', newInput);
}
</script>
@endsection
