<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Setting;
class AdminDashboardController extends Controller
{
    public function index(){
        $faqsCount = Faq::count();
        $totalViews = Faq::sum('views');
        $topFaqs = Faq::orderBy('views', 'desc')->take(5)->get();
        $currentOption = Setting::where('key', 'categoryDisplayOption')->value('value');
        return view('admin.dashboard', compact('faqsCount', 'totalViews', 'topFaqs', 'currentOption'));
    }
}
