<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(GeneralSettingSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(GovernorateSeeder::class);
        $this->call(CardSeeder::class);
        $this->call(GiftSeeder::class);
        $this->call(NotificationTimeSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
/*         $this->call(AdminSeeder::class);
 */        $this->call(IntroImagesSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategoryAndSubCategorySeeder::class);
        $this->call(SellerProductSeeder::class);
        $this->call(SubscriptionSeeder::class);
        $this->call(PollSeeder::class);
        $this->call(PosSeeder::class);
        $this->call(AgentSeeder::class);
        $this->call(ShippingCompanySeeder::class);
    }
}
