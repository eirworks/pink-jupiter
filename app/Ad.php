<?php

namespace App;

use App\Search\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ad extends Model
{
    use SoftDeletes;
    use Searchable;

    protected $casts = [
        'data' => 'array',
        'activated' => 'boolean'
    ];

    protected $with = [
        'user',
    ];

    protected $searchable = [
        'name', 'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function clicks()
    {
        return $this->hasMany(Click::class, 'service_id');
    }
}
