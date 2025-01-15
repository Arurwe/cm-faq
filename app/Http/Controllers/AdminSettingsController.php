<?php

namespace App\Http\Controllers;


use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller{
    public function update(Request $request)
    {
        $selectedOption = $request->input('categoryDisplayOption');
    
        Setting::updateOrCreate(
            ['key' => 'categoryDisplayOption'],
            ['value' => $selectedOption]
        );
    
        return redirect()->back()->with('success', 'Opcja została zapisana.');
    }
    
   
    
}
