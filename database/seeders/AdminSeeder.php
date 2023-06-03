<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/* class AdminSeeder extends Seeder
{
    public function run()
    {
        $admin = Admin::query()->create([
            'name' => 'الأدمن الرئيسي',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'email' => 'admin@admin.com',
            'is_staff' => true,
            'country_id' => 1,
            'email_verified_at' => Carbon::now(),
        ]);
        $admin->assignRole(Role::query()->first());
    }
} */
