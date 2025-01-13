<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{ 
   
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'order');

        $categories = Category::query();
        switch($sort){
            case 'alphabetical':
                $categories->orderBy('name','asc');
                break;

            case 'faq_count':
                $categories->withCount('faqs')->orderBy('faqs_count','desc');
                break;
            
            default:
                $categories->orderBy('order', 'asc');
                break;
        }


        return view('faqs.categories.index', [
        'categories' => $categories->withCount('faqs')->get(),
    ]);
    }

    public function show(Category $category){
        $faqs = $category->Faqs()->paginate(10);
        return view('faqs.categories.show', compact('category', 'faqs'));
    }

    
}
