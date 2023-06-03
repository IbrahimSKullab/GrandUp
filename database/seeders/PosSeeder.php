<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Enums\AdminEnum;
use App\Models\Governorate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PosSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 50) as $i) {
            $admin = Admin::query()->create([
                'is_staff' => 0,
                'is_agent' => 0,
                'is_pos' => 1,
                'country_id' => 1,
                'name' => 'نقطة البيع رقم ' . $i,
                'phone' => '123456789' . $i,
                'address' => 'عنوان نقطة البيع رقم ' . $i,
                'governorate_id' => Governorate::query()->inRandomOrder()->first()->id,
                'password' => Hash::make('123456789'),
                'username' => "pos.$i",
                'email' => "email.pos.$i@test.com",
            ]);
            $image = [1, 2, 3, 4];
            $admin->addMedia(public_path('test_images/pos_' . $image[array_rand($image)] . '.png'))->preservingOriginal()->toMediaCollection(AdminEnum::POS_IMAGE->name);
        }
    }
}
