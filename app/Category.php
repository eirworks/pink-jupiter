<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // scope
    public function scopeParents($query)
    {
        return $query->where('parent_id', 0);
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

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
