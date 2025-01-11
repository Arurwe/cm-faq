<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Faq;
use Illuminate\Support\Str;
class FaqSearch extends Component
{

    public $query = '';
    public $faqs = [];
    public $faqVisible = true;
    public $style = 'default';

    public function updatedQuery()
    {
        if($this->faqVisible){
            $this->faqs = Faq::with('category', 'tags')
            ->where('title', 'like', '%' . $this->query . '%')
            ->orWhere('content', 'like', '%' . $this->query . '%')
            ->limit(10)
            ->get()
            ->map(function ($faq) {
                // Generowanie fragmentu treści
                if (stripos($faq->content, $this->query) !== false) {
                    $startPos = stripos($faq->content, $this->query);
                    $excerpt = substr($faq->content, max($startPos - 30, 0), 200);
                    $faq->excerpt = '...' . str_replace($this->query, '<mark>' . $this->query . '</mark>', $excerpt) . '...';
                    
                } else {
                    $faq->excerpt = Str::limit($faq->content, 100);
                }
    
                return $faq;
            });
        }
        
    }
    

    public function clearResults()
    {
        $this->faqVisible = false;
    }


    public function render()
    {
        return view('livewire.faq-search', ['style' => $this->style,]);
    }
}
