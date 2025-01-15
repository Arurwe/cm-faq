<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqFile extends Model
{
    protected $fillable =['file_path', 'content_before', 'faq_id' ];

    public function faq(){
        return $this->belongsTo(Faq::class);
    }
}
