<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Category;

class AdminCategoryController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'order'); // Domyślnie sortuj po 'order'
        $direction = $request->input('direction', 'asc'); // Domyślny kierunek 'asc'
    
        $categories = Category::orderBy($sort, $direction)->get();
    
        return view('admin.categories.index', compact('categories'));
    }
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,bmp|max:2048',
        ]);
    
        // Ścieżka do zapisu pliku
        $backgroundImagePath = null;
    
       
        $backgroundImagePath =$request->file('categoryFile')->store('categorybg', 'public'); 
        
        $order = Category::max('order');
        $order !== null ? $order++ : 1;

        Category::create([
            'name' => $request->name,
            'background_image' => $backgroundImagePath ? Storage::url($backgroundImagePath) : null,
            'order' => $order,
        ]);
        return redirect()->route('admin.categories.index')->with('success', 'Kategoria została dodana.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function changeImage(Category $category)
    {
        return view('admin.categories.change-image', compact('category'));
    }

    public function updateImage(Request $request, Category $category)
    {
        $request->validate([
            'background_image' => 'required|image|max:2048', 
        ]);

      
        if ($category->background_image) {
            Storage::disk('public')->delete($category->background_image);
        }

      
        $path = $request->file('background_image')->store('categorybg', 'public');
        $category->update(['background_image' => Storage::url($path)]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Zdjęcie zostało zaktualizowane.');
    }


  
    
    public function moveUp(Category $category)
{
    $currentOrder = $category->order;

    // Znajdź kategorię o mniejszym `order`
    $previousCategory = Category::where('order', '<', $currentOrder)
                                ->orderBy('order', 'desc')
                                ->first();

    if ($previousCategory) {
        // Zamień `order` między kategoriami
        $category->update(['order' => $previousCategory->order]);
        $previousCategory->update(['order' => $currentOrder]);
    }

    return back()->with('success', 'Kategoria przesunięta w górę.');
}

public function moveDown(Category $category)
{
    $currentOrder = $category->order;

    // Znajdź kategorię o większym `order`
    $nextCategory = Category::where('order', '>', $currentOrder)
                             ->orderBy('order', 'asc')
                             ->first();

    if ($nextCategory) {
        // Zamień `order` między kategoriami
        $category->update(['order' => $nextCategory->order]);
        $nextCategory->update(['order' => $currentOrder]);
    }

    return back()->with('success', 'Kategoria przesunięta w dół.');
}


}
