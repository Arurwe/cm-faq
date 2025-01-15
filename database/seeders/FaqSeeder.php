<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;
use Faker\Factory as Faker;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        // Przykładowe dane FAQ
        $data = [
            ['title' => 'Jak zalogować się do komputera Domenowego', 'content' => $faker->paragraph(14), 'category_id' => 1],
            ['title' => 'Czym jest domena', 'content' => $faker->paragraph(22), 'category_id' => 1],
            ['title' => 'Poczta i te sprawy', 'content' => $faker->paragraph(30), 'category_id' => 2],
            ['title' => 'Program do poczty', 'content' => $faker->paragraph(20), 'category_id' => 2],
            ['title' => 'Zapomniałem hasła do poczty', 'content' => $faker->paragraph(20), 'category_id' => 2],
            ['title' => 'Logowanie przez VPN', 'content' => $faker->paragraph(20), 'category_id' => 4],
            ['title' => 'Połącz się z siecią UJCM_ADM', 'content' => $faker->paragraph(20), 'category_id' => 5],
            ['title' => 'Połącz się z siecią UJ_Wifi', 'content' => $faker->paragraph(20), 'category_id' => 5],
            ['title' => 'Aktualizacja program XXX', 'content' =>  $faker->paragraph(20), 'category_id' => 3],
            ['title' => 'Zablokowane konto', 'content' =>  $faker->paragraph(2), 'category_id' => 1]
        ];

        foreach ($data as $item) {
            Faq::create($item);
        }
    }
}
