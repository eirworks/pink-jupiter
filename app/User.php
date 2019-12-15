<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const TYPE_USER = 0;
    const TYPE_PARTNER = 1;
    const TYPE_ADMIN = 99;

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
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'data' => 'array',
        'open_hours' => 'array',
    ];

    public function scopePartner($query)
    {
        return $query->where('type', User::TYPE_PARTNER)
            ->where('activated', true);
    }

    public function scopePending($query)
    {
        return $query->where('type', User::TYPE_PARTNER)
            ->where('activated', false);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_user')->withPivot(['price', 'description']);
    }

    public function getCategoryIdsAttribute()
    {
        return $this->categories->pluck('id')->toArray();
    }

    public function transactions()
    {
        return $this->hasMany(UserTransaction::class);
    }
}
