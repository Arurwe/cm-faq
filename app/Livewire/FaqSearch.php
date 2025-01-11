<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Faq;
use Illuminate\Support\Str;

class FaqSearch extends Component
{
    public $query = '';
    public $faqs = [];
    public $style = 'default'; // Styl: header/main

    /**
     * Metoda wywoływana po zmianie zapytania wyszukiwania
     */
    public function updatedQuery()
    {
        // Jeśli zapytanie jest za krótkie, nie wyszukuj
        if (strlen($this->query) < 3) {
            $this->faqs = [];
            return;
        }

        // Pobierz wyniki z bazy danych
        $this->faqs = Faq::with('category', 'tags')
            ->where(function ($query) {
                $query->where('title', 'like', '%' . $this->query . '%')
                    ->orWhere('content', 'like', '%' . $this->query . '%');
            })
            ->limit(5)
            ->get()
            ->map(function ($faq) {
                $faq->excerpt = $this->generateExcerpt($faq);
                return $faq;
            });
    }

    /**
     * Wyczyść wyniki wyszukiwania
     */
    public function clearResults()
    {
        $this->faqs = [];
    }

    /**
     * Generuje fragment treści z podświetleniem zapytania
     */
    protected function generateExcerpt(Faq $faq): string
    {
        // Jeśli zapytanie występuje w treści, podświetl je
        if (stripos($faq->content, $this->query) !== false) {
            $startPos = stripos($faq->content, $this->query);
            $excerpt = substr($faq->content, max($startPos - 30, 0), 200);

            return '...' . str_replace(
                $this->query,
                '<mark>' . e($this->query) . '</mark>',
                $excerpt
            ) . '...';
        }

        // W przeciwnym razie zwróć początek treści
        return Str::limit($faq->content, 100);
    }

    /**
     * Renderowanie komponentu
     */
    public function render()
    {
        return view('livewire.faq-search', [
            'style' => $this->style,
        ]);
    }
}
