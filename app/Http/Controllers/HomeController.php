<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Faq;
class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('faqs')->get();

        $mostViewedFaqs = Faq::orderBy('views', 'desc')->take(6)->get();

        return view('home', compact('categories', 'mostViewedFaqs'));
    }
}
