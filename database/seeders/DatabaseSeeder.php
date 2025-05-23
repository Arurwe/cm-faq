<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Faq;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        User::factory(2)->create();

        User::factory()->create([
            'name' => 'Adm',
            'email' => 'admin@admin.com',
            'is_admin' => '1',
        ]);

        Setting::create([
            'key' => 'categoryDisplayOption',
            'value' => 'faqs_counts',
        ]);

        $this->call(CategorySeeder::class);
        $this->call(FaqSeeder::class);

    }
}
