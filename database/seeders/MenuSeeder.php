<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use App\Models\MenuSection;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        if (MenuSection::query()->exists()) {
            return;
        }

        $data = [
            'es' => [
                'menu' => [
                    'Entrantes' => [
                        ['Croquetas de jamon', 'Cremosas y crujientes', '6.5'],
                        ['Ensalada tropical', 'Mango, aguacate y lima', '8.0'],
                    ],
                    'Principales' => [
                        ['Hamburguesa Favela', 'Carne 180g, queso y salsa de la casa', '12.5'],
                        ['Tacos de pollo', 'Con guacamole y pico de gallo', '10.0'],
                    ],
                    'Postres' => [
                        ['Brownie de chocolate', 'Con helado de vainilla', '6.0'],
                        ['Cheesecake', 'Frutos rojos', '6.5'],
                    ],
                ],
                'cocktails' => [
                    'Clasicos' => [
                        ['Mojito', 'Ron blanco, hierbabuena, lima', '8.0'],
                        ['Margarita', 'Tequila, triple sec, lima', '8.5'],
                    ],
                    'Signature' => [
                        ['Favela Sunset', 'Ron oscuro, maracuya, especias', '9.5'],
                        ['Samba Spritz', 'Aperitivo, citricos, burbujas', '9.0'],
                    ],
                ],
                'shots' => [
                    'Shots' => [
                        ['Tequila shot', 'Con sal y lima', '3.5'],
                        ['Chupito de hierbas', 'Dulce y suave', '3.5'],
                    ],
                ],
            ],
            'en' => [
                'menu' => [
                    'Starters' => [
                        ['Iberian croquettes', 'Creamy and crispy', '6.5'],
                        ['Tropical salad', 'Mango, avocado, lime', '8.0'],
                    ],
                    'Mains' => [
                        ['Favela burger', '180g beef, cheese, house sauce', '12.5'],
                        ['Chicken tacos', 'Guacamole and pico de gallo', '10.0'],
                    ],
                    'Desserts' => [
                        ['Chocolate brownie', 'With vanilla ice cream', '6.0'],
                        ['Cheesecake', 'Red berries', '6.5'],
                    ],
                ],
                'cocktails' => [
                    'Classics' => [
                        ['Mojito', 'White rum, mint, lime', '8.0'],
                        ['Margarita', 'Tequila, triple sec, lime', '8.5'],
                    ],
                    'Signature' => [
                        ['Favela Sunset', 'Dark rum, passion fruit, spices', '9.5'],
                        ['Samba Spritz', 'Aperitif, citrus, bubbles', '9.0'],
                    ],
                ],
                'shots' => [
                    'Shots' => [
                        ['Tequila shot', 'With salt and lime', '3.5'],
                        ['Herbal shot', 'Sweet and smooth', '3.5'],
                    ],
                ],
            ],
            'pt' => [
                'menu' => [
                    'Entradas' => [
                        ['Croquetes de presunto', 'Cremosos e crocantes', '6.5'],
                        ['Salada tropical', 'Manga, abacate e lima', '8.0'],
                    ],
                    'Pratos principais' => [
                        ['Hamburguer Favela', 'Carne 180g, queijo e molho da casa', '12.5'],
                        ['Tacos de frango', 'Guacamole e pico de gallo', '10.0'],
                    ],
                    'Sobremesas' => [
                        ['Brownie de chocolate', 'Com gelado de baunilha', '6.0'],
                        ['Cheesecake', 'Frutos vermelhos', '6.5'],
                    ],
                ],
                'cocktails' => [
                    'Classicos' => [
                        ['Mojito', 'Rum branco, hortela, lima', '8.0'],
                        ['Margarita', 'Tequila, triple sec, lima', '8.5'],
                    ],
                    'Signature' => [
                        ['Favela Sunset', 'Rum escuro, maracuja, especiarias', '9.5'],
                        ['Samba Spritz', 'Aperitivo, citricos, borbulhas', '9.0'],
                    ],
                ],
                'shots' => [
                    'Shots' => [
                        ['Shot de tequila', 'Com sal e lima', '3.5'],
                        ['Shot de ervas', 'Doce e suave', '3.5'],
                    ],
                ],
            ],
        ];

        foreach ($data as $lang => $pages) {
            foreach ($pages as $page => $sections) {
                $sectionPos = 1;
                foreach ($sections as $sectionTitle => $items) {
                    $section = MenuSection::create([
                        'lang' => $lang,
                        'page' => $page,
                        'title' => $sectionTitle,
                        'position' => $sectionPos++,
                    ]);

                    $itemPos = 1;
                    foreach ($items as $item) {
                        MenuItem::create([
                            'menu_section_id' => $section->id,
                            'name' => $item[0],
                            'description' => $item[1],
                            'price' => $item[2],
                            'position' => $itemPos++,
                        ]);
                    }
                }
            }
        }
    }
}
