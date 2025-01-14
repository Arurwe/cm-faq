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
            ['name' => 'Domena', 'order' => '1' ,'background_image' => '/storage/categorybg/domena.png'],
            ['name' => 'Poczta E-mail', 'order' => '2' ,'background_image' => '/storage/categorybg/e-mail.jpg'],
            ['name' => 'Oprogramowanie', 'order' => '4' ,'background_image' => '/storage/categorybg/program.jpg'],
            ['name' => 'Praca Zdalna', 'order' => '6' ,'background_image' => '/storage/categorybg/zdalna.jpg'],
            ['name' => 'Wi-Fi', 'order' => '5' ,'background_image' => '/storage/categorybg/wi-fi.jpg'],
            ['name' => 'Drukarki i skanery', 'order' => '6' ,'background_image' => '/storage/categorybg//printer.jpg'],
            ['name' => 'Komputery służbowe', 'order' => '9' ,'background_image' => '/storage/categorybg/ws-tech2.jpg'],
            ['name' => 'Wsparcie techniczne', 'order' => '8' ,'background_image' => '/storage/categorybg/ws-tech.png'],
            ['name' => 'EZD', 'order' => '3' ,'background_image' => '/storage/categorybg/ws-tech.png'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
