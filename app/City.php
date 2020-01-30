<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'id', 'name', 'province_id'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }
}
