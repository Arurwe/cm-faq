<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'background_image', 'order'];
    
    public function faqs(){
        return $this->hasMany(Faq::class);
    }

    public function faqsCount()
    {
        return $this->faqs()->count();
    }

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($category) {
        
            \App\Models\Faq::where('category_id', $category->id)
                ->update(['category_id' => 0]);
        });
    }
}
