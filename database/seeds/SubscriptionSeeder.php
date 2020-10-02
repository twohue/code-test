<?php

use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Basic Subscription Tier
        DB::table('subscriptions')->insert([
            'name'  => 'Basic',
            'price' => 199
        ]);

        // Create Unlimited Subscription Tier
        DB::table('subscriptions')->insert([
            'name'  => 'Unlimited',
            'price' => 299
        ]);

        // Create Premium Subscription Tier
        DB::table('subscriptions')->insert([
            'name'  => 'Premium',
            'price' => 899
        ]);
    }
}
