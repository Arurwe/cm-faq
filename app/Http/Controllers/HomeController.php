<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Setting;
class HomeController extends Controller
{
    public function index()
    {
     
        $categoryDisplayOption = Setting::where('key', 'categoryDisplayOption')->value('value');
        $categoriesQuery = Category::withCount('faqs');
        
        switch ($categoryDisplayOption) {
            case 'alphabetic':
                $categoriesQuery->orderBy('name', 'asc');
                break;
            
            case 'faqs_count':
                $categoriesQuery->orderByDesc('faqs_count');
                break;
    
            case 'order':
                $categoriesQuery->orderBy('order', 'asc');
                break;
    
            default:
                $categoriesQuery->orderByDesc('faqs_count');
                break;
        }
    
        $categories = $categoriesQuery->take(8)->get();

        $mostViewedFaqs = Faq::orderBy('views', 'desc')->take(6)->get();
    
        return view('home', compact('categories', 'mostViewedFaqs'));
    }
    
}
