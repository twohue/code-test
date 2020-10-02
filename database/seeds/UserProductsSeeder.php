<?php

use Illuminate\Database\Seeder;
use App\Models\{User, Product};

class UserProductsSeeder extends Seeder
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
            $products = Product::all()->random(10);
            $user->products()->attach($products);
        }
    }
}
