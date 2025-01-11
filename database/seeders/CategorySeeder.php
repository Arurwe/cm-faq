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
            ['name' => 'Domena', 'background_image' => '/images/categoryBG/logowanie.jpg'],
            ['name' => 'Poczta E-mail', 'background_image' => '/images/categoryBG/e-mail.jpg'],
            ['name' => 'Oprogramowanie', 'background_image' => '/images/categoryBG/logowanie.jpg'],
            ['name' => 'Praca Zdalna', 'background_image' => '/images/categoryBG/logowanie.jpg'],
            ['name' => 'Wi-Fi', 'background_image' => '/images/categoryBG/wi-fi.jpg'],
            ['name' => 'Drukarki i skanery', 'background_image' => '/images/categoryBG/printer.jpg'],
            ['name' => 'Komputery służbowe', 'background_image' => '/images/categoryBG/logowanie.jpg'],
            ['name' => 'Wsparcie techniczne', 'background_image' => '/images/categoryBG/logowanie.jpg'],
            
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
