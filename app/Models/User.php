<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'roles','email_verified_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['role_names','permissions','subscription_type','subscription_id'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_user');
    }

    public function subscription()
    {
        return $this->belongsToMany(Subscription::class, 'subscription_user');
    }

    public function getSubscriptionTypeAttribute()
    {
        return $this->subscription()->pluck('name');
    }

    public function getSubscriptionIdAttribute()
    {
        return $this->subscription()->pluck('id');
    }

    public function getRoleNamesAttribute()
    {
        return $this->getRoleNames();
    }

    public function getPermissionsAttribute()
    {
        return $this->getPermissionsViaRoles()->pluck('name');
    }
}
