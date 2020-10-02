<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{

    protected $with = ['subscription'];

    protected $appends = ['slug'];

    public function user()
    {
        return $this->belongsToMany(User::class, 'product_user');
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class, 'id', 'subscription_id');
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->name);
    }
}
