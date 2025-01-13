<form method="POST" action="{{ route('admin.categories.updateImage', $category) }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="background_image" class="block text-gray-700 font-medium mb-2">Nowe zdjęcie tła</label>
        <input type="file" name="background_image" id="background_image" class="block w-full p-2 border rounded-lg">
        @error('background_image')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
        Zmień zdjęcie
    </button>
</form>
