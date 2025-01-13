<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SearchQuery;

class SearchQueryController extends Controller
{
    public function index()
    {
        $searchQueries = SearchQuery::orderByDesc('count')->get();
        return view('admin.search-queries.index', compact('searchQueries'));
    }
}
