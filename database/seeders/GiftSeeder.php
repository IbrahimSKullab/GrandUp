<?php

namespace Database\Seeders;

use App\Models\Gift;
use App\Enums\GiftEnum;
use Illuminate\Database\Seeder;

class GiftSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 10) as $i) {
            $g1 = Gift::query()->create([
                'title' => [
                    'ar' => "الهدية رقم $i",
                    'en' => "Gift Number $i",
                ],
                'description' => [
                    'ar' => "الهدية رقم $i",
                    'en' => "Gift Number $i",
                ],
                'points' => 100 * $i,
            ]);
            $g1->addMedia(public_path('test_images/gift.jpg'))->preservingOriginal()->toMediaCollection(GiftEnum::GIFT_CARD_IMAGE->name);
        }
    }
}
