<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
class AdminDashboardController extends Controller
{
    public function index(){
        $faqsCount = Faq::count();
        return view('admin.dashboard', compact('faqsCount'));
    }
}
