<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubscriptionUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('subscription_id')->constrained()->onDelete('cascade');
            $table->timestamp('subscribed_at');
            $table->timestamp('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_user');
    }
}
