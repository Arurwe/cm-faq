<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
class AdminDashboardController extends Controller
{
    public function index(){
        $faqsCount = Faq::count();
        $totalViews = Faq::sum('views');
        $topFaqs = Faq::orderBy('views', 'desc')->take(5)->get();
        return view('admin.dashboard', compact('faqsCount', 'totalViews', 'topFaqs'));
    }
}
