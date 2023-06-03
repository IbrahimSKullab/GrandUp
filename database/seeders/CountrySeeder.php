<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'title' => [
                'ar' => 'العراق',
                'en' => 'Iraq',
            ],
            'code' => 'IQ',
        ]);

        Country::create([
            'title' => [
                'ar' => 'السودان',
                'en' => 'Sudan',
            ],
            'code' => 'SD',
        ]);

        Country::create([
            'title' => [
                'ar' => 'الامارات العربية المتحدت',
                'en' => 'United Arab Emirates',
            ],
            'code' => 'AE',
        ]);
    }
}
