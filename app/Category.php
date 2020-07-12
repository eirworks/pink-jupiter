<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const TYPE_SERVICE = 'service';
    const TYPE_SHOP = 'shop';
    const TYPE_TOOLS = 'tools';

    // scope
    public function scopeParents($query)
    {
        return $query->where('parent_id', 0);
    }

    public static function categories()
    {
        return [
            self::TYPE_SERVICE => __('ads.type_service'),
            self::TYPE_SHOP => __('ads.type_shop'),
            self::TYPE_TOOLS => __('ads.type_tools'),
        ];
    }

    public function getTypeNameAttribute()
    {
        $cats = collect(self::categories());
        return $cats->get($this->type, self::TYPE_SERVICE);
    }

    // relationships

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'category_user');
    }

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }
}
