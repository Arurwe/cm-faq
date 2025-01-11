<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Category;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query', '');
    
        $faqs = Faq::with('category')
            ->where('title', 'like', "%$query%")
            ->orWhere('content', 'like', "%$query%")
            ->paginate(4);
    
        return view('faqs.index', compact('faqs', 'query'));
    }
    
    public function show(Faq $faq){
        $faq->increment('views');
        return view('faqs.show', compact('faq'));
    }

    // public function exportToPdf()
    // {
    //     $faqs = Faq::all();
    //     $pdf = \PDF::loadView('faqs.pdf', compact('faqs'));
    //     return $pdf->download('faqs.pdf');
    // }
}
