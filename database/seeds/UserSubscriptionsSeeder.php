<?php

use Illuminate\Database\Seeder;
use App\Models\{User, Subscription};

class UserSubscriptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach($users as $user) {
            $subscription = array();
            $subscriptionId = Subscription::inRandomOrder()->limit(1)->get()->first()->id;
            $subscription['subscribed_at'] = Date(now());
            $subscription['expires_at'] = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", strtotime($subscription['subscribed_at'])) . " + 1 year"));
            $user->subscription()->attach($subscriptionId, $subscription); // Attach subscription to user
        }
    }
}
