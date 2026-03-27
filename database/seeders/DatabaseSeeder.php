<?php

namespace Database\Seeders;

use App\Models\MenuPage;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (!MenuPage::query()->exists()) {
            $pages = [
                ['locale' => 'es', 'page' => 'menu', 'payload' => ['heading' => 'Menu', 'subtitle' => 'Clasicos tropicales con un giro de Rio', 'hours' => 'Mar-dom - 14:00 a 03:00', 'ad' => 'Chupitos a 1.50', 'sections' => []]],
                ['locale' => 'es', 'page' => 'cocktails', 'payload' => ['heading' => 'Cocteles', 'subtitle' => 'Firmas de la casa con un toque tropical', 'hours' => 'Mar-dom - 14:00 a 03:00', 'ad' => '', 'sections' => []]],
                ['locale' => 'es', 'page' => 'shots', 'payload' => ['heading' => 'Chupitos', 'subtitle' => 'Clasicos y especiales de la casa', 'hours' => 'Mar-dom - 14:00 a 03:00', 'ad' => '', 'sections' => []]],
                ['locale' => 'en', 'page' => 'menu', 'payload' => ['heading' => 'Menu', 'subtitle' => 'Tropical classics with a Rio twist', 'hours' => 'Tue-Sun - 14:00 to 03:00', 'ad' => 'Shots from 1.50', 'sections' => []]],
                ['locale' => 'en', 'page' => 'cocktails', 'payload' => ['heading' => 'Cocktails', 'subtitle' => 'House signatures with a tropical touch', 'hours' => 'Tue-Sun - 14:00 to 03:00', 'ad' => '', 'sections' => []]],
                ['locale' => 'en', 'page' => 'shots', 'payload' => ['heading' => 'Shots', 'subtitle' => 'Classics and house specials', 'hours' => 'Tue-Sun - 14:00 to 03:00', 'ad' => '', 'sections' => []]],
                ['locale' => 'pt', 'page' => 'menu', 'payload' => ['heading' => 'Menu', 'subtitle' => 'Classicos tropicais com um toque do Rio', 'hours' => 'Ter-dom - 14:00 as 03:00', 'ad' => 'Doses a 1.50', 'sections' => []]],
                ['locale' => 'pt', 'page' => 'cocktails', 'payload' => ['heading' => 'Coqueteis', 'subtitle' => 'Assinaturas da casa com um toque tropical', 'hours' => 'Ter-dom - 14:00 as 03:00', 'ad' => '', 'sections' => []]],
                ['locale' => 'pt', 'page' => 'shots', 'payload' => ['heading' => 'Chupitos', 'subtitle' => 'Classicos e especiais da casa', 'hours' => 'Ter-dom - 14:00 as 03:00', 'ad' => '', 'sections' => []]],
            ];

            foreach ($pages as $page) {
                MenuPage::query()->create([
                    'locale' => $page['locale'],
                    'page' => $page['page'],
                    'payload' => json_encode($page['payload'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                ]);
            }
        }

        // User::factory(10)->create();

        User::query()->firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('password')]
        );
    }
}
