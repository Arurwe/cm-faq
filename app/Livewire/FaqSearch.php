<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Faq;

class FaqSearch extends Component
{

    public $query = '';
    public $faqs = [];

    public function updatedQuery(){
        
        $this->faqs = Faq::with('category','tags')
        ->where('title', 'like', '%' . $this->query . '%')
        ->orWhere('content', 'like', '%' . $this->query . '%')
        ->limit(10)
        ->get();
    }

    public function render()
    {
        return view('livewire.faq-search');
    }
}
