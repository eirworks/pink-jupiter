<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }
}
