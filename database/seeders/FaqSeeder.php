<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        // Przykładowe dane FAQ
        $data = [
            ['title' => 'Domena', 'content' => 'Logowanie', 'category_id' => 1],
            ['title' => 'Domena coakda', 'content' => 'sdas12321  21  a fd a a', 'category_id' => 1],
            ['title' => 'Jakie są poczty', 'content' => 'afew211 o-j  02o fs s fs', 'category_id' => 2],
            ['title' => 'Program do poczty', 'content' => 'sd32409hf9asa', 'category_id' => 2],
            ['title' => 'Zapomniałem hasła', 'content' => '32409hf9', 'category_id' => 2],
            ['title' => 'Logowanie przez VPN', 'content' => 'Logowanie tymi samymi poświadczeniami co normalnie lecz wybór tarczy', 'category_id' => 4],
            ['title' => 'Połącz się z siecią UJCM_ADM', 'content' => 'Hasło domenowe', 'category_id' => 5],
            ['title' => 'Połącz się z siecią UJ_Wifi', 'content' => 'Konto pocztowe @uj.edu.pl', 'category_id' => 5],
        ];

        foreach ($data as $item) {
            Faq::create($item);
        }
    }
}
