<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Category;
use App\Models\FaqFile;
use App\Models\Tag;
use Illuminate\Http\Request;

class AdminFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $sort = $request->input('sort', 'id');
    $direction = $request->input('direction', 'asc');
    $query = $request->input('adminSearchFaq', '');  // Zmienna do przechowywania tekstu wyszukiwania

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
        ->paginate(10); // Paginacja

    return view('admin.faqs.index', compact('faqs'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.faqs.create', compact('categories', 'tags'));
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
            'files.*' => 'nullable|file|mimes:pdf,ppt,pptx|max:10240', // Maks. 10MB na plik
            'file_descriptions.*' => 'nullable|string|max:255',
            'file_options.*' => 'nullable|integer|in:1,2,3',
            'fileFaq' => 'nullable|string|in:1', // Dodanie walidacji dla ukrytego pola
        ]);
    
        // Tworzenie FAQ
        $faqData = [
            'title' => $request->title,
            'content' => $request->faqTypePost === "1" ? 'FILE' : $request->content,
            'category_id' => $request->category_id,
        ];
    
        $faq = Faq::create($faqData);
    
        // Przetwarzanie plików
        if ($request->faqTypePost === "2") {
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $index => $file) {
                    $filePath = $file->store('faq_files', 'public');
        
                    FaqFile::create([
                        'faq_id' => $faq->id,
                        'file_path' => $filePath,
                        'content_before' => $request->file_descriptions[$index] ?? null,
                        'option' => $request->file_options[$index] ?? 1,
                    ]);
                }
            }
        }
        if ($request->faqTypePost === "1") {
            if ($request->hasFile('faqfile')) {
                $filePath = $request->file('faqfile')->store('faq_files', 'public');
                FaqFile::create([
                    'faq_id' => $faq->id,
                    'file_path' => $filePath,
                    'content_before' => null, 
                    'option' => 3,           
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
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.faqs.edit', compact('faq', 'categories', 'tags'));
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
        $faq->tags()->sync($request->tags);

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
