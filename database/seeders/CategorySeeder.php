<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    
    public function run()
    {
        $categories = [
            ['name' => 'Domena'],
            ['name' => 'Poczta E-mail'],
            ['name' => 'Oprogramowanie'],
            ['name' => 'Praca Zdalna'],
            ['name' => 'Wi-Fi'],
            ['name' => 'Drukarki i skanery'],
            ['name' => 'Komputery służbowe'],
            ['name' => 'Wsparcie techniczne'],
            
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
