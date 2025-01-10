<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];
    
    public function faqs(){
        return $this->hasMany(Faq::class);
    }

    public function faqsCount()
    {
        return $this->faqs()->count();
    }
}
