<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Category;
use App\Models\FaqFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class AdminFaqController extends Controller
{
    
    public function index(Request $request)
{
    $sort = $request->input('sort', 'id');
    $direction = $request->input('direction', 'asc');
    $query = $request->input('adminSearchFaq', '');  // przechowuje tekstu wyszukiwania

    $faqs = Faq::with('category')
        // Dodajemy wyszukiwanie tylko, jeśli wprowadzone jest hasło w polu wyszukiwania
        ->when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('faqs.title', 'like', '%' . $query . '%');
            });
        })
        // Sortowanie po nazwie kategorii
        ->when($sort === 'category_name', function ($queryBuilder) use ($direction) {
            $queryBuilder->join('categories', 'faqs.category_id', '=', 'categories.id')
                         ->select('faqs.*', 'categories.name as category_name')
                         ->orderBy('categories.name', $direction);
        }, function ($queryBuilder) use ($sort, $direction) {
            // Sortowanie po innych polach
            $queryBuilder->orderBy($sort, $direction);
        })
        ->paginate(15);

    return view('admin.faqs.index', compact('faqs'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.faqs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Walidacja danych
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'string',
            'category_id' => 'required|exists:categories,id',
            'faqFile.*' => 'nullable|file|mimes:pdf,ppt,pptx|max:10240', // Maks. 10MB na plik
            'file_descriptions.*' => 'nullable|string|max:255',
            'file_options.*' => 'nullable|integer|in:1,2,3',
            'fileFaq' => 'nullable|string|in:1', // Dodanie walidacji dla ukrytego pola
        ]);
    
        // Tworzenie FAQ
        $faqData = [
            'title' => $request->title,
            'content' => $request->faqTypePost === "3" ? $request->faqDescription : $request->content,
            'category_id' => $request->category_id,
            'file_option' => $request->faqTypePost,
        ];
    
        $faq = Faq::create($faqData);
    
        // Przetwarzanie plików
        // forma Tekst pisany + załącznik do pobrania
        if ($request->faqTypePost === "1") {
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $index => $file) {
                    $filePath = $file->store('faq_files', 'public');
        
                    FaqFile::create([
                        'faq_id' => $faq->id,
                        'file_path' => $filePath,
                        'content_before' => $request->file_descriptions[$index] ?? null,
                        
                    ]);
                }
            }
        }

        // PDF jako zawartość
        if ($request->faqTypePost === "3") {
            if ($request->hasFile('faqfile')) {
                $filePath = $request->file('faqfile')->store('faq_files', 'public');
                FaqFile::create([
                    'faq_id' => $faq->id,
                    'file_path' => $filePath,
                    'content_before' => null, 
                              
                ]);
            }
        }
    
    
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ zostało dodane.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
{
    // Pobieranie kategorii
    $categories = Category::all();
    
    // Pobieranie wartości file_option z FAQ
    $fileOption = $faq->file_option; // Pobieramy wartość file_option z FAQ
    
    // Sprawdzamy wartość file_option
    if ($fileOption == 3) {
        // Jeśli file_option ma wartość 3, pobierz tylko jeden rekord
        $option = FaqFile::where('faq_id', $faq->id)->first(); // Pobieramy tylko pierwszy plik
    } else {
        // Jeśli file_option nie ma wartości 3, pobieramy wszystkie pliki
        $option = FaqFile::where('faq_id', $faq->id)->get(); // Pobieramy wszystkie pliki związane z FAQ
    }
    
    return view('admin.faqs.edit', compact('faq', 'categories', 'option'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
        ]);

        $faq->update($data);

        if ($request->has('remove_files')) {
            foreach ($request->remove_files as $fileId) {
                $file = FaqFile::find($fileId);
                
                if ($file) {
                    // Usuwamy plik z dysku
                    Storage::disk('public')->delete($file->file_path);
                    
                    // Usuwamy rekord z tabeli faq_files
                    $file->delete();
                }
            }
        }
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ zaktualizowano pomyślnie!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ usunięto pomyślnie!');
    }
}
