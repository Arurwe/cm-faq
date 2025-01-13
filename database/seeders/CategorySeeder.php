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
            ['name' => 'Domena', 'order' => '1' ,'background_image' => '/images/categoryBG/domena.png'],
            ['name' => 'Poczta E-mail', 'order' => '2' ,'background_image' => '/images/categoryBG/e-mail.jpg'],
            ['name' => 'Oprogramowanie', 'order' => '3' ,'background_image' => '/images/categoryBG/program.jpg'],
            ['name' => 'Praca Zdalna', 'order' => '4' ,'background_image' => '/images/categoryBG/zdalna.jpg'],
            ['name' => 'Wi-Fi', 'order' => '5' ,'background_image' => '/images/categoryBG/wi-fi.jpg'],
            ['name' => 'Drukarki i skanery', 'order' => '6' ,'background_image' => '/images/categoryBG/printer.jpg'],
            ['name' => 'Komputery służbowe', 'order' => '7' ,'background_image' => '/images/categoryBG/ws-tech2.jpg'],
            ['name' => 'Wsparcie techniczne', 'order' => '8' ,'background_image' => '/images/categoryBG/ws-tech.png'],
            
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
