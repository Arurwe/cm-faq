<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{ 
   
    public function index()
    {
        $categories = Category::withCount('faqs')
            ->orderBy('order') 
            ->get();
        return view('faqs.categories.index', compact('categories'));
    }

    public function show(Category $category){
        $faqs = $category->Faqs()->paginate(10);
        return view('faqs.categories.show', compact('category', 'faqs'));
    }

    
}
