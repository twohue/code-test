<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SubscriptionSeeder::class); // Products have foreign relation to Subscription tiers, so this comes first.
        $this->call(ProductSeeder::class); // Products can now be seeded.
        $this->call(UserSeeder::class); // Seed users
        $this->call(UserSubscriptionsSeeder::class); // Give users a subscription type
        $this->call(UserProductsSeeder::class); // Give users some products
        $this->call(RoleSeeder::class); // Set up roles and assign to users
        $this->call(PermissionSeeder::class); // Set up permissions and assign to roles
        $this->call(TempUserSeeder::class); // Create my testing user !! REMOVE BEFORE COMMIT !!
    }
}
