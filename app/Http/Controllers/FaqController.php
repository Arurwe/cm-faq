<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Category;
use App\Models\SearchQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query', '');
    
        // Zapisz frazę wyszukiwania 
        if (!empty($query)) {
            SearchQuery::updateOrCreate(
                ['query' => $query],
                ['count' => DB::raw('count + 1')] 
            );
        }
    
        // Przeszukiwanie FAQ
        $faqs = Faq::with('category')
            ->where('title', 'like', "%$query%")
            ->orWhere('content', 'like', "%$query%")
            ->paginate(10);
    
        return view('faqs.index', compact('faqs', 'query'));
    }
    

    public function show(Faq $faq)
{
 
    $faq->increment('views'); 
    $faq->load('files');

    return view('faqs.show', compact('faq'));
}


    // public function exportToPdf()
    // {
    //     $faqs = Faq::all();
    //     $pdf = \PDF::loadView('faqs.pdf', compact('faqs'));
    //     return $pdf->download('faqs.pdf');
    // }

   
}
