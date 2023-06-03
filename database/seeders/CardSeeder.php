<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    public function run()
    {
        Card::query()->create([
            'title' => [
                'ar' => 'فئة 5 دولار',
                'en' => '5 Dollar',
            ],
            'card_price' => 5,
            'points' => 100,
        ]);
        Card::query()->create([
            'title' => [
                'ar' => 'فئة 10 دولار',
                'en' => '10 Dollar',
            ],
            'card_price' => 10,
            'points' => 200,
        ]);
        Card::query()->create([
            'title' => [
                'ar' => 'فئة 20 دولار',
                'en' => '20 Dollar',
            ],
            'card_price' => 20,
            'points' => 400,
        ]);
        Card::query()->create([
            'title' => [
                'ar' => 'فئة 50 دولار',
                'en' => '50 Dollar',
            ],
            'card_price' => 50,
            'points' => 1000,
        ]);
        Card::query()->create([
            'title' => [
                'ar' => 'فئة 100 دولار',
                'en' => '100 Dollar',
            ],
            'card_price' => 100,
            'points' => 2000,
        ]);
    }
}
