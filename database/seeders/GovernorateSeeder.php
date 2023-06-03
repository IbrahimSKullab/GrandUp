<?php

namespace Database\Seeders;

use App\Models\Governorate;
use Illuminate\Database\Seeder;

class GovernorateSeeder extends Seeder
{
    public function run()
    {
        Governorate::query()->create([
            'title' => [
                'ar' => 'بغداد',
                'en' => 'Baghdad',
            ],
            'country_id' => 1,
        ]);
        
        Governorate::query()->create([
            'title' => [
                'ar' => 'البصرة',
                'en' => 'Basrah',
            ],
            'country_id' => 1,
        ]);
        
        Governorate::query()->create([
            'title' => [
                'ar' => 'نينوى',
                'en' => 'Nineveh',
            ],
            'country_id' => 1,
        ]);
        
        Governorate::query()->create([
            'title' => [
                'ar' => 'أربيل',
                'en' => 'Erbil',
            ],
            'country_id' => 1,
        ]);
        
        Governorate::query()->create([
            'title' => [
                'ar' => 'النجف',
                'en' => 'Najaf',
            ],
            'country_id' => 1,
        ]);
        
        Governorate::query()->create([
            'title' => [
                'ar' => 'ذي قار',
                'en' => 'Dhi Qar',
            ],
            'country_id' => 1,
        ]);
        
        Governorate::query()->create([
            'title' => [
                'ar' => 'كركوك',
                'en' => 'Kirkuk',
            ],
            'country_id' => 1,
        ]);
        
        Governorate::query()->create([
            'title' => [
                'ar' => 'الأنبار',
                'en' => 'Al Anbar',
            ],
            'country_id' => 1,
        ]);
    }
}
