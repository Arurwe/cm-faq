<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Faq;
class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('faqs')->orderByDesc('faqs_count')->take(8)->get();

        $mostViewedFaqs = Faq::orderBy('views', 'desc')->take(6)->get();

        return view('home', compact('categories', 'mostViewedFaqs'));
    }
}
