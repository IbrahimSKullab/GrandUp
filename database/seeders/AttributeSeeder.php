<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    public function run()
    {
        Attribute::query()->create([
            'title' => [
                'ar' => 'قابل للقياس',
                'en' => 'Measurable'
            ],
        ]);
        
        Attribute::query()->create([
            'title' => [
                'ar' => 'جديد',
                'en' => 'new'
            ],
        ]);
        
        Attribute::query()->create([
            'title' => [
                'ar' => 'عروض خاصة',
                'en' => 'special offers'
            ],
        ]);
        
        Attribute::query()->create([
            'title' => [
                'ar' => 'الحجم',
                'en' => 'size'
            ],
        ]);
        
        Attribute::query()->create([
            'title' => [
                'ar' => 'السعه',
                'en' => 'amplitude'
            ],
        ]);
        
        Attribute::query()->create([
            'title' => [
                'ar' => 'color',
                'en' => 'اللون'
            ],
        ]);
    }
}
