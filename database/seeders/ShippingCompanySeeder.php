<?php

namespace Database\Seeders;

use App\Models\ShippingCompany;
use Illuminate\Database\Seeder;

class ShippingCompanySeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(0, 10) as $i) {
            ShippingCompany::query()->create([
                'title' => "شركة رقم $i",
                'phone' => "12345678999$i",
                'governorate_id' => 1,
            ]);
        }
    }
}
