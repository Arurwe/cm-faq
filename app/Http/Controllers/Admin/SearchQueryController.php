<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SearchQuery;
use Illuminate\Http\Request;

class SearchQueryController extends Controller
{
    // public function index(Request $request)
    // {
    //     if(isset($request->adminSearchQueries)){
    //             $query = $request->adminSearchQueries;
    //             $searchQueries = SearchQuery::where('query', 'like', "%$query%")->paginate(20);
    //         }
    //     else{



    //         $searchQueries = SearchQuery::orderByDesc('count')->get();
    //     }
        
    //     return view('admin.search-queries', compact('searchQueries'));
    // }
    public function index(Request $request)
    {
        $query = $request->input('adminSearchQueries', ''); // Wyszukiwane zapytanie
        $sort = $request->input('sort', 'count'); // Domyślna kolumna sortowania
        $direction = $request->input('direction', 'desc'); // Domyślny kierunek sortowania
    
        // Pobierz dane z filtrem i sortowaniem
        $searchQueries = SearchQuery::when(!empty($query), function ($q) use ($query) {
                $q->where('query', 'like', "%$query%");
            })
            ->orderBy($sort, $direction) // Sortowanie na podstawie zapytań
            ->paginate(20); // Paginacja
    
        return view('admin.search-queries', compact('searchQueries', 'query', 'sort', 'direction'));
    }
    

}
