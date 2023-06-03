<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AgentSeeder extends Seeder
{
    public function run()
    {
        foreach (range(0, 50) as $i) {
            $agent = Admin::query()->create([
                'is_agent' => 1,
                'is_staff' => 0,
                'is_pos' => 0,
                'country_id' => 3,
                'name' => 'الوكيل رقم ' . $i,
                'phone' => '1122233445566' . $i,
                'email' => "agent$i@test.com",
                'password' => Hash::make('123456789'),
                'username' => "agent$i",
            ]);
            $posIds = Admin::query()->where('is_pos', 1)->inRandomOrder()->take(20)->get()->pluck('id')->toArray();
            $agent->pos()->sync($posIds);
        }
    }
}
