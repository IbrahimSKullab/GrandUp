<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Enums\GuardEnum;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $superAdminRole = Role::query()->create([
            'title' => [
                'ar' => 'الأدمن الرئيسي',
                'en' => 'Super admin',
            ],
            'name' => 'super_admin',
            'guard_name' => GuardEnum::ADMIN->value,
        ]);

        $permissions = Permission::query()->where('guard_name', GuardEnum::ADMIN->value)->get();

        $superAdminRole->syncPermissions($permissions);

        $agentRole = Role::query()->create([
            'title' => [
                'ar' => 'وكيل',
                'en' => 'Agent',
            ],
            'name' => 'agent',
            'guard_name' => GuardEnum::AGENT->value,
        ]);

        $posRole = Role::query()->create([
            'title' => [
                'ar' => 'نقطة البيع',
                'en' => 'POS',
            ],
            'name' => 'pos',
            'guard_name' => GuardEnum::POS->value,
        ]);
    }
}
