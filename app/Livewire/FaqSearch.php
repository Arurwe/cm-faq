<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Faq;
use Illuminate\Support\Str;

class FaqSearch extends Component
{
    public $query = '';
    public $faqs = [];
    public $style = "";

    public function updatedQuery()
    {
        if (strlen($this->query) > 2) {
            $this->faqs = Faq::query()
                ->where('title', 'like', '%' . $this->query . '%')
                ->orWhere('content', 'like', '%' . $this->query . '%')
                ->get();
        } else {
            $this->faqs = [];
        }
    }

    public function render()
    {
        return view('livewire.faq-search');
    }
}
