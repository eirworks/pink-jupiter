<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    public static function specialPages()
    {
        return [
            'about-us',
            'terms',
            'privacy',
        ];
    }

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    public function scopePages($query)
    {
        return $query->where('page', true)
            ->whereNotIn('slug', self::specialPages())
            ->whereNotNull('published_at');
    }
}
