<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Category;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
            'background_image' => 'required|image|max:2048', // Walidacja zdjęcia
        ]);

        // Usuń poprzednie zdjęcie (opcjonalne)
        if ($category->background_image) {
            Storage::disk('public')->delete($category->background_image);
        }

        // Zapisz nowe zdjęcie
        $path = $request->file('background_image')->store('categories', 'public');
        $category->update(['background_image' => $path]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Zdjęcie zostało zaktualizowane.');
    }
}
